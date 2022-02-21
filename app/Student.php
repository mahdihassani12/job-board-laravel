<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'firstName','lastName','fatherName','email', 'phone','address','gender','user_skills',
        'profile_image','school_name','school_address','scholl_graduation_year','uni_percentage',
        'uni_enrolled_year','faculty_id','department_id','uni_graduation_year','season','user_id',
        'mother_tonque','education_level','master_entry_date','master_field','master_percentage',
        'master_end_date','research','achievement','school_percentage'
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function faculty()
    {
        return $this->belongsTo('App\faculty','faculty_id');
    }

    public function department()
    {
        return $this->belongsTo('App\department','department_id');
    }

    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function skills(){
        return $this->belongsToMany(Skill::class,'student_skill');
    }
}
