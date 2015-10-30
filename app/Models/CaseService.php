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
    protected $fillable = ['place','progress','observations','service_detail','notices','remaining'];

    public function customer()
    {
        return $this->belongsToMany(Customer::class);
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

}
