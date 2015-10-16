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
    'cost','commission','discount','travel_expenses','isr','miscellaneous_expense','advance_payment','surcharges','isnjin'];

    public function case_service()
    {
        return $this->hasOne(CaseService::class);
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }

}
