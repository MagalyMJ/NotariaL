<?php

namespace NotiAPP\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'address';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['street','number','colony','postal_code',
    'observations'];

}
