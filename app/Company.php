<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table = 'companies';

    protected $fillable = [
        'name', 'email', 'phone','description','type','address','foundation_year','logo','user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
}
