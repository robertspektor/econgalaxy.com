<?php

namespace Database\Seeders;

use App\Models\MegaCorporation;
use App\Models\Module;
use App\Models\WeaponModule;
use Illuminate\Database\Seeder;

class PeregrineRoboticsWeaponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [
                'name' => 'Spectre Beam',
                'category' => 'Light Weapon',
                'primary_damage' => 65,
                'primary_type' => 'energy',
                'secondary_damage' => 20,
                'secondary_type' => 'electronic',
                'range' => 80,
                'accuracy' => 90,
                'cooldown' => 1,
                'special_ability' => 'Stealth Bypass - Ignores target evasion bonuses for one round.',
                'description' => 'A precision energy weapon designed to bypass most evasive maneuvers, ideal for stealth attacks.',
            ],
            [
                'name' => 'Phantom Shard Launcher',
                'category' => 'Medium Weapon',
                'primary_damage' => 85,
                'primary_type' => 'kinetic',
                'secondary_damage' => 15,
                'secondary_type' => 'corrosive',
                'range' => 70,
                'accuracy' => 87,
                'cooldown' => 2,
                'special_ability' => 'Armor Pierce - Reduces target armor by 10% for the next round.',
                'description' => 'A launcher that fires high-speed kinetic shards designed to penetrate armor efficiently.',
            ],
            [
                'name' => 'Void Disruptor',
                'category' => 'Heavy Weapon',
                'primary_damage' => 100,
                'primary_type' => 'electronic',
                'secondary_damage' => 30,
                'secondary_type' => 'energy',
                'range' => 90,
                'accuracy' => 85,
                'cooldown' => 3,
                'special_ability' => 'System Hack - Disables target weapon systems for one round.',
                'description' => 'A heavy disruptor beam aimed at weakening and disabling enemy electronics in critical systems.',
            ],
            [
                'name' => 'Reaper’s Sting',
                'category' => 'Light Weapon',
                'primary_damage' => 55,
                'primary_type' => 'kinetic',
                'secondary_damage' => 25,
                'secondary_type' => 'corrosive',
                'range' => 65,
                'accuracy' => 88,
                'cooldown' => 1,
                'special_ability' => 'Toxic Spread - Adds 5 damage over time to the target for 2 rounds.',
                'description' => 'Fires high-velocity corrosive projectiles that latch onto targets, slowly eroding armor.',
            ],
        ];

        foreach ($modules as $module) {
            // Create the base entry in the `modules` table
            $baseModule = Module::create([
                'name' => $module['name'],
                'type' => 'weapon',
                'mega_corporation_id' => MegaCorporation::where('name', 'Peregrine Robotics')->first()->id,
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
