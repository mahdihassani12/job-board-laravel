<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table="skills";
    protected $fillable =["name"];

    public function students(){
    	return $this->belongsToMany(Student::class,'student_skill');
    }

}
