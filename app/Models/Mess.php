<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mess extends Model
{
    protected $table = 'mess';

    protected $fillable = [
        'name',
        'address',
        'from',
        'image',
        'status',
    ];

    public function settings()
    {
        return $this->hasMany(\App\Models\MessSettings::class,'mess_id','id');
    }

    public function users()
    {
        return $this->hasMany(\App\User::class,'mess_id','id');
    }

    public function admins()
    {
        return $this->hasMany(\App\User::class,'mess_id','id')->where('priority',1);
    }
    
    public function members()
    {
        return $this->hasMany(\App\User::class,'mess_id','id')->where('priority',0);
    }
}
