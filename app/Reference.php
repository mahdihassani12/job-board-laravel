<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'student_references';

    protected $fillable = [
        'reference_email', 'reference_phone','student_id'
    ];


    public function student(){
        return $this->belongsTo('App\Student');
    }
}
