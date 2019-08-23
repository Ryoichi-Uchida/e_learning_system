<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [];

    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    public function option()
    {
        return $this->belongsTo('App\Option');
    }
}
