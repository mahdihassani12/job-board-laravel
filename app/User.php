<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email', 'password','role','status','primary_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


     public function isAdmin() {
       return $this->role === 'admin';
    }

    public function isUser() {
       return $this->role === 'user';
    }

    public function isCompany() {
       return $this->role === 'company';
    }

    // relations

    public function company(){
        return $this->hasOne('App\Company');
    }

    public function student(){
        return $this->hasOne('App\Student');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}
