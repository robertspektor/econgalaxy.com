<?php

namespace App\Traits;

use App\Models\System;
use App\Models\Planet;
use App\Models\Moon;

trait HasLocation
{
    public function location()
    {
        return match ($this->location_type) {
            'system' => $this->belongsTo(System::class, 'location_id'),
            'planet' => $this->belongsTo(Planet::class, 'location_id'),
            'moon' => $this->belongsTo(Moon::class, 'location_id'),
            default => null,
        };
    }

    public function getLocationLabelAttribute()
    {
        if (!$this->location) {
            return 'Unknown';
        }

        return match ($this->location_type) {
            'system' => 'System: ' . $this->location->name,
            'planet' => 'Planet: ' . $this->location->name . ' (' . $this->location->system->name . ')',
            'moon' => 'Moon: ' . $this->location->name . ' (' . $this->location->planet->name . ')',
            default => 'Unknown',
        };
    }

    public function getCoordinatesAttribute()
    {
        if (!$this->location) {
            return ['x' => 0, 'y' => 0];
        }

        if ($this->location_type === 'system') {
            return [
                'x' => $this->location->x,
                'y' => $this->location->y,
            ];
        }

        if ($this->location_type === 'planet') {
            $system = $this->location->system;
            $angle = deg2rad($this->location->angle);
            return [
                'x' => $system->x + $this->location->orbitRadius * cos($angle),
                'y' => $system->y + $this->location->orbitRadius * sin($angle),
            ];
        }

        if ($this->location_type === 'moon') {
            $planet = $this->location->planet;
            $system = $planet->system;
            $planetAngle = deg2rad($planet->angle);
            $moonAngle = deg2rad($this->location->angle);
            $planetX = $system->x + $planet->orbitRadius * cos($planetAngle);
            $planetY = $system->y + $planet->orbitRadius * sin($planetAngle);
            return [
                'x' => $planetX + $this->location->orbitRadius * cos($moonAngle),
                'y' => $planetY + $this->location->orbitRadius * sin($moonAngle),
            ];
        }

        return ['x' => 0, 'y' => 0];
    }
}
