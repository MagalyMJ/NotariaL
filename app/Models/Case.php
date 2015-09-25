<?php

namespace NotiAPP\Models;

use Illuminate\Database\Eloquent\Model;

class Case extends Model
{
    //
        protected $table = 'case';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['place','progress','colony','observations'];

    public function participant()
    {
        return $this->belongsTo(Participant::class,'participants_id');
    }

    public function budget()
    {
        return $this->hasOne(Budget::class,'budget_id');
    }
}
