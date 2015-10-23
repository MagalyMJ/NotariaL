<?php

namespace NotiAPP\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    //
      //
        protected $table = 'budget';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['approved','invoiced','payment_type','discount',
    'advance_payment','total','commission','travel_expenses','miscellaneous_expense',
    'surcharges','iva','sub_total','fee','operation_value','isr','isnjin',
    'isabi','property_valuation','commercial_appraisal','writing_management','n_registration'
    ,'total_registration_costs','n_certificates','total_certified_expenditure',
    'edicts','n_extra_hours','n_extra_paper'];

    public function case_service()
    {
        return $this->hasOne(CaseService::class);
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function FeeByOpertationVaule($OperationValue){
        //La formula pra obtener un Honorario en bace al valor de operacion es
        //Honorarios = (tasa marginal sobrante del execente inferior * valor de operación) + Cuota fija 
        $TMEI = 0; //Tasa marginal sobre execente inferior 
        $cuotaFija = 0; 
        $fee = 0;

        if ($OperationValue <= 100000) {
             $fee = 2200; 
             return $fee;

        }elseif ($OperationValue > 100000 && $OperationValue <= 250000) {
            $cuotaFija = 4500;
            $TMEI = 1.5;
            $fee = (($TMEI * $OperationValue )/100) + $cuotaFija;
            return $fee;

        }elseif ($OperationValue > 250000 && $OperationValue <= 500000) {
            $cuotaFija = 8000;
            $TMEI = 1.2;
            $fee = (($TMEI * $OperationValue )/100)  + $cuotaFija;
            return $fee;

        }elseif ($OperationValue > 500000 && $OperationValue <= 750000) {
            $cuotaFija = 12000;
            $TMEI = 1.0;
            $fee = (($TMEI * $OperationValue )/100)  + $cuotaFija;
            return $fee;

        }elseif ($OperationValue > 750000 && $OperationValue <= 1000000) {
            $cuotaFija = 16000;
            $TMEI = 0.8;
            $fee = (($TMEI * $OperationValue )/100)  + $cuotaFija;
            return $fee;

        }elseif ($OperationValue > 1000000 && $OperationValue <= 2000000) {
            $cuotaFija = 24000;
            $TMEI = 0.6;
            $fee = (($TMEI * $OperationValue )/100) + $cuotaFija;
            return $fee;

        }elseif ($OperationValue > 2000000 && $OperationValue <= 5000000) {
            $cuotaFija = 45000;
            $TMEI = 0.4;
            $fee = (($TMEI * $OperationValue )/100)  + $cuotaFija;
            return $fee;

        }elseif ($OperationValue > 5000000 && $OperationValue <= 10000000) {
            $cuotaFija = 60000;
            $TMEI = 0.2;
            $fee = (($TMEI * $OperationValue )/100) + $cuotaFija;
            return $fee;

        }elseif ($OperationValue > 10000000 ) {
            $cuotaFija = 750000;
            $TMEI = 0.1;
            $fee = (($TMEI * $OperationValue )/100)  + $cuotaFija;
            return $fee;

        }
    }

    public function SubTotal(){

         return  $this->fee + $this->total_extra_hours - $this->discount 
                    + $this->travel_expenses + $this->miscellaneous_expense 
                    + $this->surcharges + $this->isr + $this->isnjin + $this->isabi 
                    + $this->property_valuation + $this->commercial_appraisal + $this->writing_management 
                    + $this->total_registration_costs + $this->total_certified_expenditure  + $this->total_extra_paper;
              
        /*el Subtotal = Honorarios + el total de horas extra (Fe de hechos) - el descuento de honorarios + 
                            Gastos de viaje + Gastos varios + recargos + isr + isnjin + isabi +
                            Avaluo catastral + Avalauo comercial + Gestoria de Escritura 
                            Gastros de registro + gastos de certificados + hojas extra (Cotejo y certificacion)
                            
                */
    }

}
