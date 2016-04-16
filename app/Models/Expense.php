<?php

namespace NotiAPP\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
      //
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'expenses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['expense_name'];

    public function services()
    {
        return $this->belongsToMany(Service::class,'service_expenses','service_id','expenses_id');
    }
}
