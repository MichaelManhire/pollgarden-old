<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->where('is_deleted', 0);
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function gender()
    {
        return $this->belongsTo('App\Gender');
    }

    public function getAvatar()
    {
        if (is_null($this->avatar)) {
            return 'https://api.adorable.io/avatars/200/' . $this->slug . '.png';
        }

        return asset('storage/' . $this->avatar);
    }

    public function getConversations()
    {
        $receivedConversations = $this->receivedConversations;
        $sentConversations = $this->sentConversations;
        $conversations = $sentConversations->merge($receivedConversations);
        $conversations = $conversations->filter(function ($conversation) {
            return $conversation->messages->count();
        });
        $conversations = $conversations->sortByDesc(function ($conversation) {
            return $conversation->messages->first()->created_at;
        });

        return $conversations;
    }

    public function polls()
    {
        return $this->hasMany('App\Poll')->where('is_deleted', 0);
    }

    public function receivedConversations()
    {
        return $this->hasMany('App\Conversation', 'recipient_id');
    }

    public function sentConversations()
    {
        return $this->hasMany('App\Conversation', 'sender_id');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }
}
