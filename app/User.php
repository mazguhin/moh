<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isModer()
    {
        if (Auth::user()->permission>=2)
            return 1;
        return 0;
    }

    public function isAdmin()
    {
        if (Auth::user()->permission>=3)
            return 1;
        return 0;
    }

    public function logs() {
        return $this->hasMany('\App\Log');
    }
}
