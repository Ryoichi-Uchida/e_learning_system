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

    public function is_lesson_starting($id)
    {
        if(!empty($this->lessons->where('category_id', $id)->first()->answers)){
            return true;
        }else{
            return false;
        }
    }

    public function finished_question_no($id)
    {
        $count = $this->lessons->where('category_id', $id)->first()->answers->count();
        return $count;
    }

    public function finished_all_no()
    {
        $lessons = $this->lessons()->get();

        //count questions & correct answers the user learned
        $all_no = 0;
        $correct_no = 0;

        //getting one lesson
        foreach ($lessons as $lesson) {
            //getting one answer user choosed from this lesson
            foreach ($lesson->answers as $answer) {
                //The case of uncorrect
                if ($answer->option->content != $lesson->category->questions->where('id', $answer->question_id)->first()->correct_option()) {
                    $all_no += 1;
                //The case of correct
                }else{
                    $all_no += 1;
                    $correct_no += 1;
                }
            }
        }

        return array( 'all' => $all_no, 'correct' => $correct_no);
    }
}
