<?php

namespace NotiAPP\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
        protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','payment_type','amount_to_pay','remaining','total'];


   public function case_service()
    {
        return $this->belongsTo(CaseService::class);
    }
}
