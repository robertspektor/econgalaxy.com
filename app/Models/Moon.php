<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moon extends Model
{
    protected $guarded = [];

    public function planet()
    {
        return $this->belongsTo(Planet::class);
    }
}
