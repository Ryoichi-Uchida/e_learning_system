<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function options()
    {
        return $this->hasMany('App\Option');
    }

    public function correct_option()
    {
        return $this->options->where('is_correct', 1)->first()->content;
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
