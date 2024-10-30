<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

//    public function employees(): \Illuminate\Database\Eloquent\Relations\HasMany
//    {
//        return $this->hasMany(Employee::class);
//    }

    public function fleets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Fleet::class);
    }
}
