<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contactMessages extends Model
{
    protected $table="contact_messages";
    protected $fillable =["name","description","phone","email"];
}
