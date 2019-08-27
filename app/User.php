<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Activity;

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
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id')->withTimestamps();
    }

    public function is_following($id)
    {
        if(!empty($this->following()->where('followed_id', $id)->first())){
            return true;
        }else{
            return false;
        }
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson', 'user_id');
    }

    //The func distinguishes a lesson is already starting or not. 
    public function is_lesson_starting($id)
    {
        if(!empty($this->lessons->where('category_id', $id)->first()->answers)){
            return true;
        }else{
            return false;
        }
    }

    //The func counts number of answers already done.
    public function finished_question_no($id)
    {
        $count = $this->lessons->where('category_id', $id)->first()->answers->count();

        return $count;
    }

    //The func creates a new lesson-activity.
    public function make_lesson_activity($id)
    {
        $this->lessons->where('category_id', $id)->first()->activities()->create(['user_id' => $this->id]);
    }

    //The func retrieves activity of specific user.
    public function activities()
    {
        return Activity::where('user_id', $this->id)->orderBy('created_at', 'desc');
    }

}
