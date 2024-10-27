<?php

namespace Database\Seeders;

use App\Models\MegaCorporation;
use App\Models\Module;
use App\Models\WeaponModule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EchoCovertWeaponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [
                'name' => 'Silent Striker',
                'category' => 'Light Weapon',
                'primary_damage' => 55,
                'primary_type' => 'kinetic',
                'secondary_damage' => 15,
                'secondary_type' => 'corrosive',
                'range' => 70,
                'accuracy' => 92,
                'cooldown' => 1,
                'special_ability' => 'Silent Attack - Does not reveal user’s position on the map.',
                'description' => 'A silent weapon ideal for covert operations, delivering rapid hits while keeping the attacker hidden.',
            ],
            [
                'name' => 'Ghost Pulse',
                'category' => 'Light Weapon',
                'primary_damage' => 60,
                'primary_type' => 'electronic',
                'secondary_damage' => 20,
                'secondary_type' => 'energy',
                'range' => 80,
                'accuracy' => 90,
                'cooldown' => 1,
                'special_ability' => 'Jammer - Reduces target\'s accuracy by 10% for one round.',
                'description' => 'Emitting electronic pulses, this weapon jams enemy systems to provide a tactical advantage.',
            ],
            [
                'name' => 'Veil Projector',
                'category' => 'Medium Weapon',
                'primary_damage' => 75,
                'primary_type' => 'energy',
                'secondary_damage' => 25,
                'secondary_type' => 'electronic',
                'range' => 85,
                'accuracy' => 88,
                'cooldown' => 2,
                'special_ability' => 'Cloak Generator - Provides temporary invisibility for one round.',
                'description' => 'A weapon that projects a cloaking field, enabling stealthier strikes with energy bursts.',
            ],
            [
                'name' => 'Phantom Lance',
                'category' => 'Heavy Weapon',
                'primary_damage' => 110,
                'primary_type' => 'energy',
                'secondary_damage' => 20,
                'secondary_type' => 'corrosive',
                'range' => 90,
                'accuracy' => 85,
                'cooldown' => 3,
                'special_ability' => 'Phase Strike - Passes through shields, dealing full damage to armor directly.',
                'description' => 'A stealth-oriented lance weapon capable of bypassing shields and directly impacting armored hulls.',
            ],
        ];

        foreach ($modules as $module) {
            // Create the base entry in the `modules` table
            $baseModule = Module::create([
                'name' => $module['name'],
                'type' => 'weapon',
                'mega_corporation_id' => MegaCorporation::where('name', 'Echo Covert Operations')->first()->id,
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
