<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password','dob','profession','from','image','mess_id','priority'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function mess()
    {
        return $this->hasOne(\App\Models\Mess::class,'id','mess_id');
    }

    public function expenses()
    {
        return $this->hasMany(\App\Models\Expenses::class,'user_id','id');
    }

    public function meals()
    {
        return $this->hasMany(\App\Models\Meals::class,'user_id','id');
    }
}
