<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'slug'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function quotes()
    {
         return $this->belongsTo('App\Models\Quote');
    }

    public function coments()
    {
        return $this->hasMany('App\Models\QuoteComment');
    }

    public function notifications()
    {
       return $this->hasMany('App\Models\Notification');
    }
}
