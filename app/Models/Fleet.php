<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    protected $guarded = [
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function ships(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Ship::class);
    }
}
