<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'from',
        'to',
        'subject',
        'body',
        'channel',
        'priority',
        'folder',
        'is_read',
        'received_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'received_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
