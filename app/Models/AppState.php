<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppState extends Model
{
    protected $fillable = [
        'user_id',
        'app_name',
        'opened',
        'minimized',
        'position',
        'size',
    ];

    protected $casts = [
        'position' => 'array',
        'size' => 'array',
        'opened' => 'boolean',
        'minimized' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
