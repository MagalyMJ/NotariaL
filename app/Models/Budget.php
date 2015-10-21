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
    protected $fillable = ['approved','invoiced','payment_type','operation_value',
    'total','commission','discount','travel_expenses','isr','miscellaneous_expense','advance_payment','surcharges','isnjin','fee'];

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
            $fee = ($TMEI * $OperationValue ) + $cuotaFija;
            return $fee;

        }elseif ($OperationValue > 250000 && $OperationValue <= 500000) {
            $cuotaFija = 8000;
            $TMEI = 1.2;
            $fee = ($TMEI * $OperationValue ) + $cuotaFija;
            return $fee;

        }elseif ($OperationValue > 500000 && $OperationValue <= 750000) {
            $cuotaFija = 12000;
            $TMEI = 1.0;
            $fee = ($TMEI * $OperationValue ) + $cuotaFija;
            return $fee;

        }elseif ($OperationValue > 750000 && $OperationValue <= 1000000) {
            $cuotaFija = 16000;
            $TMEI = 0.8;
            $fee = ($TMEI * $OperationValue ) + $cuotaFija;
            return $fee;

        }elseif ($OperationValue > 1000000 && $OperationValue <= 2000000) {
            $cuotaFija = 24000;
            $TMEI = 0.6;
            $fee = ($TMEI * $OperationValue ) + $cuotaFija;
            return $fee;

        }elseif ($OperationValue > 2000000 && $OperationValue <= 5000000) {
            $cuotaFija = 45000;
            $TMEI = 0.4;
            $fee = ($TMEI * $OperationValue ) + $cuotaFija;
            return $fee;

        }elseif ($OperationValue > 5000000 && $OperationValue <= 10000000) {
            $cuotaFija = 60000;
            $TMEI = 0.2;
            $fee = ($TMEI * $OperationValue ) + $cuotaFija;
            return $fee;

        }elseif ($OperationValue > 10000000 ) {
            $cuotaFija = 750000;
            $TMEI = 0.1;
            $fee = ($TMEI * $OperationValue ) + $cuotaFija;
            return $fee;

        }
    }

    public function fillBugetByService(/*Los parametros que nos mandarian */ $Request, /*nombre del servicio*/ $Service){

        switch ($Service) {
            case 'Testamento':
                $this->approved;
                break;
            
            default:
                # code...
                break;
        }

    }

}
