<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    protected $fillable = [
        'name', 'faculty_id'
    ];

    public function faculties()
    {
        return $this->hasMany(faculty::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
