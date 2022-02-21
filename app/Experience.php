<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'description', 'start_date', 'end_date', 'student_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function student(){
        return $this->belongsTo('App\Student');
    }
}
