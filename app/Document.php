<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    protected $fillable = [
        'document_type', 'document_name','student_id'
    ];

    public function student(){
        return $this->belongsTo('App\Student','student_id');
    }
}
