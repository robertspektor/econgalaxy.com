<?php

namespace Database\Seeders;

use App\Models\MegaCorporation;
use App\Models\Module;
use App\Models\PropulsionModule;
use Illuminate\Database\Seeder;

class PropulsionModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [
                'name' => 'Stellar Drive',
                'type' => 'impulse',
                'mega_corporation' => 'Stellar Dynamics',
                'power_consumption' => 200,
                'max_speed' => 120.5,
                'acceleration' => 30,
                'cooldown' => 1,
                'stability' => 90,
                'description' => 'High-speed impulse drive optimized for quick maneuvers, designed for Stellar Dynamics agile ships.',
            ],
            [
                'name' => 'Galactic Warp Core',
                'type' => 'warp',
                'mega_corporation' => 'Galactic Federation Shipyards',
                'power_consumption' => 300,
                'max_warp_factor' => 9,
                'warp_range' => 600,
                'cooldown' => 3,
                'stability' => 95,
                'description' => 'Stable and reliable warp drive for long-distance travel, ensuring smooth transit for Federation fleets.',
            ],
            [
                'name' => 'Exploration Jump Drive',
                'type' => 'jump',
                'mega_corporation' => 'Deep Space Discoveries Ltd.',
                'power_consumption' => 500,
                'jump_range' => 1000,
                'charge_time' => 5,
                'cooldown' => 4,
                'stability' => 85,
                'description' => 'Jump drive built for deep-space exploration, providing exceptional range for reaching remote territories.',
            ],
            [
                'name' => 'Phantom Stealth Drive',
                'type' => 'impulse',
                'mega_corporation' => 'Peregrine Robotics',
                'power_consumption' => 180,
                'max_speed' => 110.0,
                'acceleration' => 35,
                'cooldown' => 1,
                'stability' => 92,
                'description' => 'An impulse drive optimized for stealth, enabling quick and quiet movements for tactical advantage.',
            ],
            [
                'name' => 'Titanium Core Impulse Engine',
                'type' => 'impulse',
                'mega_corporation' => 'Astral Heavy Industries',
                'power_consumption' => 220,
                'max_speed' => 90.0,
                'acceleration' => 20,
                'cooldown' => 2,
                'stability' => 100,
                'description' => 'Durable impulse drive designed for industrial and heavy-duty ships, balancing power with resilience.',
            ],
            [
                'name' => 'Defender Warp Drive',
                'type' => 'warp',
                'mega_corporation' => 'Union Defense Corp.',
                'power_consumption' => 320,
                'max_warp_factor' => 8,
                'warp_range' => 550,
                'cooldown' => 3,
                'stability' => 98,
                'description' => 'Fortified warp drive with built-in defensive systems, ideal for protected transit through risky zones.',
            ],
            [
                'name' => 'Covert Jump Matrix',
                'type' => 'jump',
                'mega_corporation' => 'Echo Covert Operations',
                'power_consumption' => 450,
                'jump_range' => 850,
                'charge_time' => 4,
                'cooldown' => 3,
                'stability' => 80,
                'description' => 'Specialized jump drive allowing covert units to evade detection during long-distance travel.',
            ],
        ];

        foreach ($modules as $module) {
            // Create the base entry in the `modules` table
            $baseModule = Module::create([
                'name' => $module['name'],
                'type' => 'propulsion',
                'mega_corporation_id' => MegaCorporation::where('name', $module['mega_corporation'])->first()->id,
            ]);

            // Create the propulsion-specific entry in the `propulsion_modules` table
            PropulsionModule::create([
                'module_id' => $baseModule->id, // Link to the `modules` entry
                'propulsion_type' => $module['type'],
                'power_consumption' => $module['power_consumption'],
                'max_speed' => $module['max_speed'] ?? null,
                'acceleration' => $module['acceleration'] ?? null,
                'max_warp_factor' => $module['max_warp_factor'] ?? null,
                'warp_range' => $module['warp_range'] ?? null,
                'jump_range' => $module['jump_range'] ?? null,
                'charge_time' => $module['charge_time'] ?? null,
                'cooldown' => $module['cooldown'],
                'stability' => $module['stability'],
            ]);
        }
    }
}
