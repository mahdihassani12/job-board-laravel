<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'title', 'description', 'user_id','sender_id','status'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
