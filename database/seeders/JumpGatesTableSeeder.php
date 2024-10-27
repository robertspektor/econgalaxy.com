<?php

namespace Database\Seeders;

use App\Models\JumpGate;
use App\Models\Sector;
use Illuminate\Database\Seeder;

class JumpGatesTableSeeder extends Seeder
{
    public function run()
    {
        $jumpGates = [
            // Galactic Federation Jump Gates
            [
                'sector_id' => Sector::where('name', 'Nova Solari')->first()->id,
                'target_sector_id' => Sector::where('name', 'Vega Proxima')->first()->id,
                'x' => 150,
                'y' => 160,
                'distance' => 15,
            ],
            [
                'sector_id' => Sector::where('name', 'Vega Proxima')->first()->id,
                'target_sector_id' => Sector::where('name', 'Nova Solari')->first()->id,
                'x' => 300,
                'y' => 200,
                'distance' => 15,
            ],
            [
                'sector_id' => Sector::where('name', 'Vega Proxima')->first()->id,
                'target_sector_id' => Sector::where('name', 'Luna Minor')->first()->id,
                'x' => 340,
                'y' => 250,
                'distance' => 10,
            ],
            [
                'sector_id' => Sector::where('name', 'Luna Minor')->first()->id,
                'target_sector_id' => Sector::where('name', 'Vega Proxima')->first()->id,
                'x' => 180,
                'y' => 250,
                'distance' => 10,
            ],
            // Trade Syndicate Jump Gates
            [
                'sector_id' => Sector::where('name', 'Aurelian Expanse')->first()->id,
                'target_sector_id' => Sector::where('name', 'Nyx Void')->first()->id,
                'x' => 550,
                'y' => 260,
                'distance' => 20,
            ],
            [
                'sector_id' => Sector::where('name', 'Nyx Void')->first()->id,
                'target_sector_id' => Sector::where('name', 'Aurelian Expanse')->first()->id,
                'x' => 700,
                'y' => 340,
                'distance' => 20,
            ],
            [
                'sector_id' => Sector::where('name', 'Nyx Void')->first()->id,
                'target_sector_id' => Sector::where('name', 'Eldara Drift')->first()->id,
                'x' => 670,
                'y' => 310,
                'distance' => 12,
            ],
            [
                'sector_id' => Sector::where('name', 'Eldara Drift')->first()->id,
                'target_sector_id' => Sector::where('name', 'Nyx Void')->first()->id,
                'x' => 640,
                'y' => 290,
                'distance' => 12,
            ],
            // Rebel Alliance Jump Gates
            [
                'sector_id' => Sector::where('name', 'Orion Outpost')->first()->id,
                'target_sector_id' => Sector::where('name', 'Zion Prime')->first()->id,
                'x' => 120,
                'y' => 620,
                'distance' => 12,
            ],
            [
                'sector_id' => Sector::where('name', 'Zion Prime')->first()->id,
                'target_sector_id' => Sector::where('name', 'Orion Outpost')->first()->id,
                'x' => 200,
                'y' => 680,
                'distance' => 12,
            ],
            [
                'sector_id' => Sector::where('name', 'Zion Prime')->first()->id,
                'target_sector_id' => Sector::where('name', 'Keldor Rim')->first()->id,
                'x' => 230,
                'y' => 700,
                'distance' => 14,
            ],
            [
                'sector_id' => Sector::where('name', 'Keldor Rim')->first()->id,
                'target_sector_id' => Sector::where('name', 'Zion Prime')->first()->id,
                'x' => 140,
                'y' => 720,
                'distance' => 14,
            ],
            // Explorers Guild Jump Gates
            [
                'sector_id' => Sector::where('name', 'Helios Frontier')->first()->id,
                'target_sector_id' => Sector::where('name', 'Erebus Reach')->first()->id,
                'x' => 900,
                'y' => 200,
                'distance' => 22,
            ],
            [
                'sector_id' => Sector::where('name', 'Erebus Reach')->first()->id,
                'target_sector_id' => Sector::where('name', 'Helios Frontier')->first()->id,
                'x' => 900,
                'y' => 400,
                'distance' => 22,
            ],
            [
                'sector_id' => Sector::where('name', 'Erebus Reach')->first()->id,
                'target_sector_id' => Sector::where('name', 'Dusk Forge')->first()->id,
                'x' => 950,
                'y' => 380,
                'distance' => 18,
            ],
            [
                'sector_id' => Sector::where('name', 'Dusk Forge')->first()->id,
                'target_sector_id' => Sector::where('name', 'Erebus Reach')->first()->id,
                'x' => 920,
                'y' => 350,
                'distance' => 18,
            ],
        ];

        foreach ($jumpGates as $gate) {
            JumpGate::create($gate);
        }
    }
}
