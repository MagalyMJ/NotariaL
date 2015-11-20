<?php

namespace NotiAPP\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
     //
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','fathers_last_name','mothers_last_name','rfc',
    'birthdate','marital_status','occupation','from','phone'];

    public function address(){
        return $this->hasMany(Address::class,'customer_id');
    }
    // public function participant(){
    // 	return $this->hasMany(Participant::class,'customer_id');
    // }

    public function case_service(){

        return $this->belongsToMany(CaseService::class)->withPivot('participants_type','documents_list');
    }
}
