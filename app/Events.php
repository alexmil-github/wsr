<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = [
        'name', 'date', 'manager',
    ];
    public function themes() {
        return $this->hasMany(Theme::class);
    }
}
