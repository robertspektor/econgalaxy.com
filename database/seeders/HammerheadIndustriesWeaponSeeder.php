<?php

namespace Database\Seeders;

use App\Models\MegaCorporation;
use App\Models\Module;
use App\Models\WeaponModule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HammerheadIndustriesWeaponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [
                'name' => 'Brawler Blaster',
                'category' => 'Light Weapon',
                'primary_damage' => 70,
                'primary_type' => 'kinetic',
                'secondary_damage' => 15,
                'secondary_type' => 'explosive',
                'range' => 60,
                'accuracy' => 82,
                'cooldown' => 1,
                'special_ability' => 'Close Combat Surge - Increases damage by 10% if within half range.',
                'description' => 'A close-range blaster built for rugged, close-quarters combat.',
            ],
            [
                'name' => 'Juggernaut Cannon',
                'category' => 'Heavy Weapon',
                'primary_damage' => 130,
                'primary_type' => 'kinetic',
                'secondary_damage' => 30,
                'secondary_type' => 'explosive',
                'range' => 80,
                'accuracy' => 78,
                'cooldown' => 3,
                'special_ability' => 'Armor Shred - Decreases target armor by 20% for 2 rounds.',
                'description' => 'A powerful, slow-firing cannon that focuses on armor penetration and sheer kinetic force.',
            ],
            [
                'name' => 'Rumble Rocket Pod',
                'category' => 'Medium Weapon',
                'primary_damage' => 100,
                'primary_type' => 'explosive',
                'secondary_damage' => 20,
                'secondary_type' => 'kinetic',
                'range' => 75,
                'accuracy' => 80,
                'cooldown' => 2,
                'special_ability' => 'Shockwave - Reduces accuracy of nearby enemies by 10% for one round.',
                'description' => 'A pod that fires explosive rounds designed to create destabilizing shockwaves.',
            ],
            [
                'name' => 'Bastion Shield Blaster',
                'category' => 'Light Weapon',
                'primary_damage' => 65,
                'primary_type' => 'energy',
                'secondary_damage' => 15,
                'secondary_type' => 'explosive',
                'range' => 70,
                'accuracy' => 85,
                'cooldown' => 1,
                'special_ability' => 'Barrier Breach - Increases shield damage by 10%.',
                'description' => 'A blaster that excels in bringing down shields, opening up targets for further assault.',
            ],
        ];

        foreach ($modules as $module) {
            // Create the base entry in the `modules` table
            $baseModule = Module::create([
                'name' => $module['name'],
                'type' => 'weapon',
                'mega_corporation_id' => MegaCorporation::where('name', 'Hammerhead Industries')->first()->id,
            ]);

            // Create the weapon-specific entry in the `weapon_modules` table
            WeaponModule::create([
                'module_id' => $baseModule->id, // Link to the `modules` entry
                'primary_damage' => $module['primary_damage'],
                'primary_type' => $module['primary_type'],
                'secondary_damage' => $module['secondary_damage'],
                'secondary_type' => $module['secondary_type'],
                'range' => $module['range'],
                'accuracy' => $module['accuracy'],
                'cooldown' => $module['cooldown'],
                'special_ability' => $module['special_ability'],
            ]);
        }
    }
}
