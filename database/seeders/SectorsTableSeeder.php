<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorsTableSeeder extends Seeder
{
    public function run()
    {
        $sectors = [
            // Galactic Federation Sectors
            [
                'name' => 'Nova Solari',
                'faction_id' => \App\Models\Faction::where('name', 'Galactic Federation')->first()->id,
                'x' => 120,
                'y' => 140,
            ],
            [
                'name' => 'Vega Proxima',
                'faction_id' => \App\Models\Faction::where('name', 'Galactic Federation')->first()->id,
                'x' => 300,
                'y' => 200,
            ],
            [
                'name' => 'Luna Minor',
                'faction_id' => \App\Models\Faction::where('name', 'Galactic Federation')->first()->id,
                'x' => 180,
                'y' => 250,
            ],
            // Trade Syndicate Sectors
            [
                'name' => 'Aurelian Expanse',
                'faction_id' => \App\Models\Faction::where('name', 'Trade Syndicate')->first()->id,
                'x' => 500,
                'y' => 220,
            ],
            [
                'name' => 'Nyx Void',
                'faction_id' => \App\Models\Faction::where('name', 'Trade Syndicate')->first()->id,
                'x' => 700,
                'y' => 340,
            ],
            [
                'name' => 'Eldara Drift',
                'faction_id' => \App\Models\Faction::where('name', 'Trade Syndicate')->first()->id,
                'x' => 640,
                'y' => 290,
            ],
            // Rebel Alliance Sectors
            [
                'name' => 'Orion Outpost',
                'faction_id' => \App\Models\Faction::where('name', 'Rebel Alliance')->first()->id,
                'x' => 100,
                'y' => 600,
            ],
            [
                'name' => 'Zion Prime',
                'faction_id' => \App\Models\Faction::where('name', 'Rebel Alliance')->first()->id,
                'x' => 200,
                'y' => 680,
            ],
            [
                'name' => 'Keldor Rim',
                'faction_id' => \App\Models\Faction::where('name', 'Rebel Alliance')->first()->id,
                'x' => 140,
                'y' => 720,
            ],
            // Explorers Guild Sectors
            [
                'name' => 'Helios Frontier',
                'faction_id' => \App\Models\Faction::where('name', 'Explorers Guild')->first()->id,
                'x' => 850,
                'y' => 150,
            ],
            [
                'name' => 'Erebus Reach',
                'faction_id' => \App\Models\Faction::where('name', 'Explorers Guild')->first()->id,
                'x' => 900,
                'y' => 400,
            ],
            [
                'name' => 'Dusk Forge',
                'faction_id' => \App\Models\Faction::where('name', 'Explorers Guild')->first()->id,
                'x' => 920,
                'y' => 350,
            ],
        ];

        foreach ($sectors as $sector) {
            Sector::create($sector);
        }
    }
}
