<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contactInfo extends Model
{
    protected $table="contact_info";
    protected $fillable =["address","description","phone","email"];
}
