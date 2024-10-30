<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class
System extends Model
{
    protected $guarded = [
    ];

    public function sectors() {
        return $this->hasMany(Sector::class);
    }

    public function planets() {
        return $this->hasMany(Planet::class);
    }

    public function fleets() {
        return $this->hasMany(Fleet::class);
    }

    public function calculateSectorsForSystem($numPlanets, $baseRadius = 100, $orbitSpacing = 100) {
        $sectors = [];

        for ($ringIndex = 1; $ringIndex < $numPlanets; $ringIndex++) {
            $innerRadius = $baseRadius + $ringIndex * $orbitSpacing;
            $outerRadius = $baseRadius + ($ringIndex + 1) * $orbitSpacing;

            // Anzahl der Sektoren für diesen Ring (z. B. 18 im innersten Ring und steigend)
            $segmentCount = 18 + ($ringIndex * 2);

            for ($segmentIndex = 1; $segmentIndex <= $segmentCount; $segmentIndex++) {
                $sectors[] = [
                    'system_id' => $this->id, // Das aktuelle System
                    'ring_index' => $ringIndex,
                    'segment_index' => $segmentIndex,
                    'inner_radius' => $innerRadius,
                    'outer_radius' => $outerRadius,
                ];
            }
        }

        return $sectors;
    }

    public function calculatePlanetsForSystem(mixed $num_planets)
    {
        $planets = [];

        for ($i = 1; $i < $num_planets; $i++) {
            $planets[] = [
                'name' => 'Planet ' . ($i + 1),
                'size' => rand(8, 15),
                'color' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
                'orbitRadius' => 100 + $i * 100,
                'angle' => rand(0, 360),
            ];
        }

        return $planets;
    }
}
