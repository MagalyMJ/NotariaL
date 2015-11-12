<?php

namespace NotiAPP\Models;

use Illuminate\Database\Eloquent\Model;

class CaseService extends Model
{
    //
        protected $table = 'case';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['place','progress','observations','service_detail','notices',
    'remaining','notices_one_date','notices_two_date','signature'];

    public function customer()
    {
        return $this->belongsToMany(Customer::class)->withPivot('participants_type','documents_list');
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

     public function service()
    {
        return $this->belongsTo(Service::class);
    }

     public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function SumPayments(){
         //suma de todos los pagos hechos
         $sumPayment = 0;

         foreach ($this->payment as $payment) {
            $sumPayment += $payment->amount_to_pay;
        }
        return $sumPayment;
    }
//Condiciones de progreso 
    public function Progress(){

        //enum( 1=>'0', 2=>'25', 3=>'33', 4=>'50', 5=>'66', 6=>'75', 7=>'99', 8=>'100)
        $progress = 1;
        switch ($this->service->service_type) {
            case 'no_enagenante':
                //al editar la el presupuesto, se genera un total, por lo que alguien ya hiso un prespuesto y pasa al 25%
                    if ( $this->budget->total > 0 ) {
                        $progress = 2;
        //si todos los clientes ya entregaron (almenos un documento) o se a dado un pago pasa a la face 50 %
                        if ( $this->CustomerDouments() || $this->payment->count() > 0 ) {
                           $progress = 4;
         //si ya entregaron documentos, se realizaron pago y se finiquito,                   
                           if( $this->CustomerDouments() && $this->payment->count() > 0 && $this->remaining <= 0 ){

                                $progress = 6;
                //Se firmo el Caso 
                                if ($this->signature == 1 ) {
                                    $progress = 8;
                                }
                            }
                        }
                    }
                    return $progress ;
                break;

            case 'enagenante':
                    //al editar la el presupuesto, se genera un total, por lo que alguien ya hiso un prespuesto y pasa al 25%
                    if ( $this->budget->total > 0 ) {
                        $progress = 2;
                 //si todos los clientes ya entregaron (almenos un documento) o se a dado un pago pasa a la face 50 %
                        if ( $this->CustomerDouments() || $this->payment->count() > 0 ) {
                           $progress = 3;
                //si ya entregaron documentos, se realizaron pago y se finiquito,                   
                           if( $this->CustomerDouments() && $this->payment->count() > 0 && $this->remaining <= 0 ){

                                $progress = 4;
                    //si se registra la fecha del primer aviso, 
                            if($this->notices_one_date != '0000-00-00') {
                                   $progress =  5;
                        //si se registra la fecha del segundo aviso
                                if ($this->notices_two_date != '0000-00-00') {
                                       $progress  = 6; 

                                       if ($this->signature == 1 ) {
                                            $progress = 8;
                                        }
                                    }
                                }  
                            }
                        }
                    }
                return $progress ;
                break;
            default:
                   return "";
                break;
        }

    }

//Evalua a todos los clientes asignados a este caso, y si lla entregaron algun documento
    private function CustomerDouments(){

        //Con que un cliente no tenga un documento, se buelve falso
        foreach ($this->customer as $customer ) {
            if (empty($customer->pivot->documents_list)) {
                return false;
            }
        }
        return true;
    }
// Evalua el numero de dias transcurriodos de un aviso en base a la ultima fecha registrada
    public function diffDateNotices(){
        $dias = 0;
        if($this->notices_one_date != '0000-00-00') {
             
             $dias   = (strtotime($this->notices_one_date)-strtotime(date("Y-m-d")))/86400; //86400 Segundos en un dia
             $dias   = abs($dias); $dias = floor($dias); 
            }
        if ($this->notices_two_date != '0000-00-00') {
                $dias   = (strtotime($this->notices_two_date)-strtotime(date("Y-m-d")))/86400; //86400 Segundos en un dia
                $dias   = abs($dias); $dias = floor($dias); 
            }

        if ($dias > 30 ) {
                return " + de 30";
         }  else{     
            return (int)$dias;
        }

    }   

}
