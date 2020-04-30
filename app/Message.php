<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message','user_id','theme_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
