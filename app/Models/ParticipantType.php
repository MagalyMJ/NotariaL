<?php

namespace NotiAPP\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantType extends Model
{
    //
    protected $table = 'participans_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function service()
    {
        return $this->belongsToMany(Service::class,'participant_type_service','service_id','participant_type_id');
    }
}
