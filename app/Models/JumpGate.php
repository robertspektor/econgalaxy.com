<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JumpGate extends Model
{
    protected $guarded = [
    ];

    public function sector(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

    public function target_sector(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }
}
