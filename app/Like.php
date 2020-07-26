<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = [];

    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }

    public function liker()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
