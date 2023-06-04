<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessSettings extends Model
{
    protected $table = 'meal_settings';

    protected $fillable = [
        'mess_id',
        'name',
        'days',
        'status',
    ];

    public function mess()
    {
        return $this->hasOne(\App\Models\Mess::class,'id','mess_id');
    }
}
