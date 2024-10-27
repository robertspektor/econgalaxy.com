<?php

namespace Database\Seeders;

use App\Models\MegaCorporation;
use App\Models\Module;
use App\Models\WeaponModule;
use Illuminate\Database\Seeder;

class UnionDefenseWeaponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [
                'name' => 'Guardian Beam',
                'category' => 'Light Weapon',
                'primary_damage' => 60,
                'primary_type' => 'energy',
                'secondary_damage' => 25,
                'secondary_type' => 'kinetic',
                'range' => 85,
                'accuracy' => 88,
                'cooldown' => 2,
                'special_ability' => 'Defensive Barrier - Reduces incoming damage by 10% for one round.',
                'description' => 'Provides solid defensive fire, designed to guard against advancing threats.',
            ],
            [
                'name' => 'Fortified Railgun',
                'category' => 'Medium Weapon',
                'primary_damage' => 100,
                'primary_type' => 'kinetic',
                'secondary_damage' => 30,
                'secondary_type' => 'explosive',
                'range' => 90,
                'accuracy' => 83,
                'cooldown' => 3,
                'special_ability' => 'Fortress Impact - Provides a 10% resistance to the user for 2 rounds.',
                'description' => 'A fortified railgun for long-range engagements, built to protect Union Defense assets.',
            ],
            [
                'name' => 'Shield Piercer',
                'category' => 'Heavy Weapon',
                'primary_damage' => 130,
                'primary_type' => 'energy',
                'secondary_damage' => 20,
                'secondary_type' => 'electronic',
                'range' => 95,
                'accuracy' => 85,
                'cooldown' => 3,
                'special_ability' => 'Shield Nullifier - Reduces target shield by 20% for one round.',
                'description' => 'An advanced energy weapon tailored to breaking through even the strongest shields.',
            ],
            [
                'name' => 'Sentinel Cannon',
                'category' => 'Heavy Weapon',
                'primary_damage' => 120,
                'primary_type' => 'kinetic',
                'secondary_damage' => 20,
                'secondary_type' => 'explosive',
                'range' => 80,
                'accuracy' => 80,
                'cooldown' => 3,
                'special_ability' => 'Suppressive Fire - Reduces enemy fire rate by 5% for 2 rounds.',
                'description' => 'A cannon designed to suppress advancing enemies, providing reliable kinetic damage with heavy firepower.',
            ],
        ];

        foreach ($modules as $module) {
            // Create the base entry in the `modules` table
            $baseModule = Module::create([
                'name' => $module['name'],
                'type' => 'weapon',
                'mega_corporation_id' => MegaCorporation::where('name', 'Union Defense Corp.')->first()->id,
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
