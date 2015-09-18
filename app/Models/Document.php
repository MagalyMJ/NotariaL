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

    public function services()
    {
        return $this->belongsToMany(Service::class,'service_documents','service_id','document_id');
    }
    
}
