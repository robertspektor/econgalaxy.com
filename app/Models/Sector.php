<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $guarded = [
    ];

    public function system() {
        return $this->belongsTo(System::class);
    }

//    public function faction(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(Faction::class);
//    }
}
