<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class faculty extends Model
{
    protected $fillable = [
        'name', 
    ];

    public function department()
    {
        return $this->belongsTo(department::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
