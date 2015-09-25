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

    public function custumer()
    {
        return $this->belongsTo(Custumer::class,'custumer_id');
    }
    
    public function case(){
    	return $this-hasOne(Case::class,'case_id');
    }
}
