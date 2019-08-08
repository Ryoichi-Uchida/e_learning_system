<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $guarded = [];

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

    public function following()
    {
        return $this->belongsToMany('App\user', 'follows', 'following_id', 'followed_id')->withTimestamps();
    }

    public function followed()
    {
        return $this->belongsToMany('App\user', 'follows', 'followed_id', 'following_id')->withTimestamps();
    }

    public function is_following($id)
    {
        if(!empty($this->following()->where('followed_id', $id)->first())){
            return true;
        }else{
            return false;
        }
    }
}
