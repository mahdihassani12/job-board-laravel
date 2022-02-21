<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public function company()
    {
        return $this->belongsTo(User::class);
    }

    public function categories(){
    	return $this->belongsToMany(category::class);
    }
}
