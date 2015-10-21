<?php

namespace NotiAPP\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
     //
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','service_type'];

     public function document_service()
    {
        return $this->belongsToMany(Document::class)->withPivot('participants_type');
    }
    public function expenses()
    {
        return $this->belongsToMany(Expense::class)->withPivot('cost','input_name','type_input');;
    }
     public function case_service()
    {
        return $this->hasOne(CaseService::class);
    }

     public function participant_type_service()
    {
        return $this->belongsToMany(ParticipantType::class);;
    }

}
