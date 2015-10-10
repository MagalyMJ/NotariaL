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
    protected $fillable = ['place','progress','colony','observations','service_detail'];

    public function customer()
    {
        return $this->belongsToMany(Customer::class,'case_service_customer','customer_id','case_service_id');
    }

    public function budget()
    {
        return $this->hasOne(Budget::class);
    }
}
