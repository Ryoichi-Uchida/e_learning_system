<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = [];

    protected $table = 'user_category';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer', 'user_category_id');
    }

    public function activities()
    {
        return $this->morphMany('App\Activity', 'activity');
    }

    //The func counts number of correct answers about a lesson.
    public function correct_no()
    {
        $correct_no = $this->answers()
                        ->whereHas('option', function($query){
                            $query->where('is_correct', 1);
                        })->count();
        
        return $correct_no;
    }
}


