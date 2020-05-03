<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollCategory extends Model
{
    public function polls()
    {
        return $this->hasMany('App\Poll');
    }
}
