<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $guarded = [];

    public function activities()
    {
        $this->morphMany('App\Activity', 'activity');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'followed_id');
    }
}