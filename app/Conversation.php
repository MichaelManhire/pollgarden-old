<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $guarded = [];

    public function messages()
    {
        return $this->hasMany('App\Message')->where('is_deleted', 0)->latest();
    }

    public function recipient()
    {
        return $this->belongsTo('App\User', 'recipient_id');
    }

    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id');
    }
}
