<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    protected $table="enrolls";
    protected $fillable =["title","description","student_id","company_id","job_id"];
}
