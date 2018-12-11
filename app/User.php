<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Friendable;

class User extends Authenticatable
{
    use Notifiable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name','gender', 'email', 'password', 'slug', 'pic',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile(){
        return $this->hasOne('App\Profile');
    }

     public function posts(){
        return $this->hasMany('App\Post');
    }

     public function likes(){
        return $this->hasMany('App\Like');
    }

    public function friends(){
        return $this->belongsTo('App\User');
    }

}
