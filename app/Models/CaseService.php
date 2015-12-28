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
    'remaining','notices_one_date','notices_two_date','public_register','signature','N_write'];

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
    /**
     * //Suma el total de los pagos efectuados para este caso 
     *
     * @return int
     */
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

//NO Se registran asi que no influye en el progreso 
        if ($this->service->name = 'Testamento' || $this->service->name = 'Sucesiónes Testamentaría' ||
                 $this->service->name = 'Sucesiónes Intestamentaría' ||
                    ($this->service->name ='Poder General' && $Caso->budget->fee == 3000 ) ) {

            return $this->ProgressoutRegister();

        }
        // NO se firman por el clinete se firman por el notario por lo que la firma no influye ene el proceso  y tampoco llevan registro
        elseif ( $this->service->name = 'Fe de Hechos' || $this->service->name = 'Cotejo y Certificación' || $this->service->name = 'Cotejo y Ratificacion') {
              
              return $this->ProgressoutRegisterSignature();
            
        } else {

        switch ($this->service->service_type) {
            case 'no_enagenante':
                
                    return $this->ProgressNo_enagenate();

                break;

            case 'enagenante':
                  
                return $this->Progress_Enagenante() ;
                break;
            default:
                   return "";
                break;
            }
        }
    }
    /**
     * //Evalua el progreso de los servicios que no requieren estar en registro publico
     *
     * @return int
     */
    private function ProgressoutRegister(){
        //enum( 1=>'0', 2=>'10', 3=>'25', 4=>'33', 5=>'50', 6=>'66', 7=>'75', 8=>'99', 9=>'100)
        $progress = 1;
         //al editar la el presupuesto, se genera un total, por lo que alguien ya hiso un prespuesto y pasa al 25%
                    if ( $this->budget->total > 0 ) {
                        $progress = 2;
                        if ( $this->budget->approved != 0  ) {
                            $progress = 4;
                            //si todos los clientes ya entregaron (almenos un documento) o se a dado un pago pasa a la face 50 %
                             if ( $this->CustomerDouments()) {
                                    $progress = 5;
                                    //si ya se firmo la escritura 
                                    if ($this->payment->count() > 0 ) { 
                                        $progress = 7;   
                                        //Cuando se firma, avansa un progreso.               
                                        if($this->remaining <= 0 ){
                                                $progress = 8;             
                                             if ( $this->signature == 1 ) {
                                                    $progress = 9;
                                    } 
                                }
                            }
                        }
                    }
                }
            return $progress;

    }
    /**
     * //Evalua el progreso de los servicios que no requieren estar en registro publico ni necesitan tenern la firma del cliente
     *
     * @return int
     */
    private function ProgressoutRegisterSignature(){
          //enum( 1=>'0', 2=>'10', 3=>'25', 4=>'33', 5=>'50', 6=>'66', 7=>'75', 8=>'99', 9=>'100)
        $progress = 1;
          //al editar la el presupuesto, se genera un total, por lo que alguien ya hiso un prespuesto y pasa al 25%
                    if ( $this->budget->total > 0 ) {
                        $progress = 2;
                        if ( $this->budget->approved != 0  ) {
                            $progress = 4;
                            //si todos los clientes ya entregaron (almenos un documento) o se a dado un pago pasa a la face 50 %
                             if ( $this->CustomerDouments()) {
                                    $progress = 5;
                                    //si ya se firmo la escritura 
                                    if ($this->payment->count() > 0 ) { 
                                        $progress = 7;   
                                        //Cuando se firma, avansa un progreso.               
                                        if($this->remaining <= 0 ){
                                                $progress = 9;                          
                                }
                            }
                        }
                    }
                }
            return $progress;
    }
    /**
     * //Evalua el progreso de los servicios no son enajeantes (no tiene avisos, y se registran )
     *
     * @return int
     */
    private function ProgressNo_enagenate(){
        //enum( 1=>'0', 2=>'10', 3=>'25', 4=>'33', 5=>'50', 6=>'66', 7=>'75', 8=>'99', 9=>'100)
        $progress = 1;
        //al editar la el presupuesto, se genera un total, por lo que alguien ya hiso un prespuesto y pasa al 25%
                    if ( $this->budget->total > 0 ) {
                        $progress = 2;
                        if ( $this->budget->approved != 0  ) {
                            $progress = 3;
                            //si todos los clientes ya entregaron (almenos un documento) o se a dado un pago pasa a la face 50 %
                             if ( $this->CustomerDouments()) {
                                    $progress = 4;
                                    //si ya se firmo la escritura 
                                    if ($this->payment->count() > 0 ) { 
                                        $progress = 5;   
                                        //Cuando se firma, avansa un progreso.               
                                        if($this->remaining <= 0 ){
                                                $progress = 7;
                                                //Se completo el pago  
                                                if ( $this->signature == 1 && $this->public_register != '0000-00-00' ) {
                                                    $progress = 9;
                                    } 
                                }
                            }
                        }
                    }
                }
            return $progress;
    }
    /**
     * //Evalua el progreso de los servicios son enajenates tiene avisos , y ser registran 
     *
     * @return int
     */
    private function Progress_Enagenante(){
        //enum( 1=>'0', 2=>'10', 3=>'25', 4=>'33', 5=>'50', 6=>'66', 7=>'75', 8=>'99', 9=>'100)
        $progress = 1;
          //al editar la el presupuesto, se genera un total, por lo que alguien ya hiso un prespuesto y pasa al 25%
                    if ( $this->budget->total > 0 ) {
                        $progress = 2;
                 //Al momento de que se aprueva un presupuesto, se mada el el primer aviso, y el progreso incrementa al 33%
                        if ( $this->budget->approved != 0 || $this->notices_one_date != '0000-00-00' ) {
                           $progress = 3;
                //si ya estan entregando documentos.                   
                           if( $this->CustomerDouments() ){
                                $progress = 4;
                    //si se se inician a hacer los pagos, evanzamos a una face nueva,  PRIMER AVISO DESPUES DE LOS PAGOS
                            if($this->payment->count() > 0 ) {
                                   $progress =  5;
                        //Cuando se firma , se manda el segundo aviso, y avansa un progreso. 
                                if ($this->signature == 1 && $this->notices_two_date != '0000-00-00') {
                                       $progress  = 7; 
                             // Ivan menciona que antes de mandarla a inscribir es cuando debe de estar ya todo pagado.
                                       if ($this->remaining <= 0 ) {
                                            $progress = 8;
                                        /// Cuando se registra en registro publico, es que todo  esta correcto 
                                            if ( $this->public_register != '0000-00-00' ){ 
                                                $progress = 9;
                                            }  
                                        }
                                    }
                                }  
                            }
                        }
                    }
            return $progress;
    }

    /**
     * //Evalua a todos los clientes asignados a este caso, y si ya entregaron algun documento.
     *
     * @return boolean
     */
    private function CustomerDouments(){

        //Con que un cliente no tenga un documento, se buelve falso
        foreach ($this->customer as $customer ) {
            if (empty($customer->pivot->documents_list)) {
                return false;
            }
        }
        return true;
    }
    /**
    * Evalua el numero de dias transcurriodos de un aviso en base a la ultima fecha registrada
    * @return int
    */
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

    /**
    * Scope para hacer una busqueda de casos por id 
    * @param Query $query , int $id, int $id_service
    * @return 
    */
    public function scopeSearchById($query, $id){

        return $query->where('id','LIKE',"$id%");
    }  
    /**
    * Scope para hacer una busqueda de casos por numero de Escritura
    * @param Query $query , int $N_write, int $id_service
    * @return 
    */
    public function scopeSearchByNwrite($query, $N_write){

        return $query->where('N_write','LIKE',"$N_write%");
    } 
    /**
    * Scope para hacer una busqueda de casos por numero de Escritura
    * @param Query $query , int $N_write, int $id_service
    * @return 
    */
    public function scopeSearchByProgress($query, $progress){

        return $query->where('progress','=',"$progress");
    }  
    
    /**
    * Scope para hacer una busqueda de casos por Nombre de Cliente
    * @param Query $query , string $FullName_write,
    * @return 
    */
    public function scopeSearchByFullNameCustomer($query,$FullName_write){

        return $query->join('case_service_customer AS CsC', 'CsC.case_service_id', '=', 'case.id')
                            ->join('customer AS c','c.id','=','CsC.customer_id')
                            ->select('case.*')
                            ->where('c.name','LIKE',"$FullName_write%")
                            ->orWhere( 'c.fathers_last_name','LIKE',"$FullName_write%")
                            ->orwhere('c.mothers_last_name','LIKE',"$FullName_write%");
    } /**
    * Scope para hacer una busqueda de casos por Nombre de Cliente y el servicio 
    * @param Query $query , string $FullName_write, int $id_service
    * @return 
    */
    public function scopeSearchByFullNameCustomerAndService($query,$FullName_write,$id_service){

        return $query->join('case_service_customer AS CsC', 'CsC.case_service_id', '=', 'case.id')
                            ->join('customer AS c','c.id','=','CsC.customer_id')
                            ->select('case.*')->where('case.service_id',$id_service)
                            ->where('c.name','LIKE',"$FullName_write%")
                            ->orWhere( 'c.fathers_last_name','LIKE',"$FullName_write%")
                            ->orwhere('c.mothers_last_name','LIKE',"$FullName_write%");
    } 
    /**
    * Scope para hacer una busqueda de casos por id y el tipo de servicio
    * @param Query $query , int $id, int $id_service
    * @return 
    */
    public function scopeSearchByIdAndService($query, $id, $id_service){

        return $query->where('id','LIKE',"$id%")->where('service_id',$id_service);
    }  
    /**
    * Scope para hacer una busqueda de casos por numero de Escritura y el tipo de servicio
    * @param Query $query , int $N_write, int $id_service
    * @return 
    */
    public function scopeSearchByNwriteAndService($query, $N_write, $id_service){

        return $query->where('N_write','LIKE',"$N_write%")->where('service_id',$id_service);
    }  

}
