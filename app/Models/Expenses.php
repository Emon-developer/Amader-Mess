<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $table = 'expenses';

    protected $fillable = [
        'user_id',
        'date',
        'expenses',
        'details',
        'status',
    ];

    public function user()
    {
        return $this->hasOne(\App\User::class,'id','user_id');
    }
}
