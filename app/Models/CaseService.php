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
    protected $fillable = ['place','progress','colony','observations'];

    public function participant()
    {
        return $this->belongsToMany(Customer::class,'participants');
    }

    public function budget()
    {
        return $this->hasOne(Budget::class);
    }
}
