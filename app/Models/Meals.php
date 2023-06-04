<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meals extends Model
{
    protected $table = 'meals';

    protected $fillable = [
        'user_id',
        'date',
        'meals',
        'details',
        'status',
    ];

    public function user()
    {
        return $this->hasOne(\App\User::class,'id','user_id');
    }
}
