<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerOrigin extends Model
{
    protected $guarded = [];

    protected $casts = [
        'benefits' => 'array',
        'drawbacks' => 'array',
    ];

}
