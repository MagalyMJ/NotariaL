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

    public function Progress(){

        //enum('0', '25', '33', '50', '66', '75', '99', '100)
        $progress = 0;
        switch ($this->service->service_type) {
            case 'no_enagenante':
                //al editar la el presupuesto, se genera un total, por lo que alguien ya hiso un prespuesto y pasa al 25%
                    if ( $this->budget->total > 0 ) {
                        $progress = 1;
        //si todos los clientes ya entregaron (almenos un documento) o se a dado un pago pasa a la face 50 %
                        if ( $this->CustomerDouments() || $this->payment->count() > 0 ) {
                           $progress = 3;
         //si ya entregaron documentos, se realizaron pago y se finiquito,                   
                           if( $this->CustomerDouments() && $this->payment->count() > 0 && $this->remaining <= 0 ){

                                $progress = 5;

                                if ($this->signature = 1 ) {
                                    $progress = 7;
                                }
                            }
                        }
                    }
                    return $progress ;
                break;
            case 'enagenante':
                
                break;
            default:
                   return "";
                break;
        }

    }

    private function CustomerDouments(){

        //Con que un cliente no tenga un documento, se buelve falso
        foreach ($this->customer as $customer ) {
            if (empty($customer->pivot->documents_list)) {
                return false;
            }
        }
        return true;
    }

}
