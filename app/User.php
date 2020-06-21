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

    public function career()
    {
        return $this->belongsTo('App\UserCareer');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function country()
    {
        return $this->belongsTo('App\UserCountry');
    }

    public function educationLevel()
    {
        return $this->belongsTo('App\UserEducationLevel');
    }

    public function ethnicity()
    {
        return $this->belongsTo('App\UserEthnicity');
    }

    public function gender()
    {
        return $this->belongsTo('App\UserGender');
    }

    public function orientation()
    {
        return $this->belongsTo('App\UserOrientation');
    }

    public function politics()
    {
        return $this->belongsTo('App\UserPolitics');
    }

    public function polls()
    {
        return $this->hasMany('App\Poll');
    }

    public function religion()
    {
        return $this->belongsTo('App\UserReligion');
    }

    public function state()
    {
        return $this->belongsTo('App\UserState');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function zodiacSign()
    {
        return $this->belongsTo('App\UserZodiacSign');
    }
}
