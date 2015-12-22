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

      /**
    * Scope para hacer una busqueda de casos por numero de Escritura
    * @param Query $query , int $N_write, int $id_service
    * @return 
    */
    public function scopeSearchByFullName($query, $FullName_write){

        return $query->where('name','LIKE',"$FullName_write%")
                    ->orWhere( 'fathers_last_name','LIKE',"$FullName_write%")
                    ->orwhere('mothers_last_name','LIKE',"$FullName_write%");
    }  
}
