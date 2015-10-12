<?php

namespace NotiAPP\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
     //
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['document_name'];

    public function document_service()
    {
        return $this->belongsToMany(Service::class,'document_service','service_id','document_id');
    }
    
}
