<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    protected $guarded = [];

    public function system()
    {
        return $this->belongsTo(System::class);
    }

    public function moons()
    {
        return $this->hasMany(Moon::class);
    }

    public function calculateMoonsForPlanet()
    {
        $numMoons = rand(0, 3);
        $moons = [];

        for ($i = 1; $i < $numMoons; $i++) {
            $moons[] = [
                'name' => 'Moon ' . ($i + 1),
                'size' => rand(3, 6),
                // gray colors for moons
                'color' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
                'orbitRadius' => 15 + $i * 15,
                'angle' => rand(0, 360),
            ];
        }

        return $moons;
    }
}
