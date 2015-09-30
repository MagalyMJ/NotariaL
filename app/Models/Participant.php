<?php

namespace NotiAPP\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    //
      //
     //
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'participants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['participants_type'];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    
    public function caseservice(){
    	return $this->hasOne(CaseService::class,'case_id');
    }
}
