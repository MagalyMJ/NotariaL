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
    protected $fillable = ['approved','invoiced','payment_type','operatin_value',
    'cost','commission'];

    public function caseservice()
    {
        return $this->belongsTo(CaseService::class);
    }

    public function service()
    {
        return $this->hasOne(Service::class,'service_id');
    }
}
