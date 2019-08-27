<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

Relation::morphMap([
    'follow' => 'App\Follow',
    'lesson' => 'App\Lesson',
]);

class Activity extends Model
{
    protected $guarded = [];

    public function activity()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return User::where('id', $this->user_id)->first();
    }
}
