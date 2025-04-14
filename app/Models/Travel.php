<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    // travels table
    protected $table = 'travels';

    protected $fillable = [
        'user_id',
        'origin_type',
        'origin_id',
        'destination_type',
        'destination_id',
        'started_at',
        'arrives_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'arrives_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function origin()
    {
        return match ($this->origin_type) {
            'system' => $this->belongsTo(System::class, 'origin_id'),
            'planet' => $this->belongsTo(Planet::class, 'origin_id'),
            'moon' => $this->belongsTo(Moon::class, 'origin_id'),
            default => null,
        };
    }

    public function destination()
    {
        return match ($this->destination_type) {
            'system' => $this->belongsTo(System::class, 'destination_id'),
            'planet' => $this->belongsTo(Planet::class, 'destination_id'),
            'moon' => $this->belongsTo(Moon::class, 'destination_id'),
            default => null,
        };
    }

    public function getDestinationLabelAttribute()
    {
        if (!$this->destination) {
            return 'Unknown';
        }

        return match ($this->destination_type) {
            'system' => 'System: ' . $this->destination->name,
            'planet' => 'Planet: ' . $this->destination->name . ' (' . $this->destination->system->name . ')',
            'moon' => 'Moon: ' . $this->destination->name . ' (' . $this->destination->planet->name . ')',
            default => 'Unknown',
        };
    }

    public function isInTransit()
    {
        return now()->isBefore($this->arrives_at);
    }

    public function completeTravel()
    {
        $user = $this->user;
        $user->location_type = $this->destination_type;
        $user->location_id = $this->destination_id;
        $user->save();

        $this->delete(); // Reise abschließen

        // Dispatch ein Event, um die Standortanzeige zu aktualisieren
        $user->dispatch('location-updated');
    }
}
