<?php

namespace Database\Seeders;

use App\Models\MegaCorporation;
use App\Models\Module;
use App\Models\WeaponModule;
use Illuminate\Database\Seeder;

class StellarDynamicsWeaponModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [
                'name' => 'Precision Pulse Laser',
                'category' => 'Light Weapon',
                'primary_damage' => 60,
                'primary_type' => 'energy',
                'secondary_damage' => 20,
                'secondary_type' => 'electronic',
                'range' => 75,
                'accuracy' => 90,
                'cooldown' => 1,
                'special_ability' => 'Precision Strike - Increases critical hit chance by 10% for one turn.',
                'description' => 'This pulse laser is designed for pinpoint accuracy, ideal for engaging smaller, evasive targets with reliable energy damage.',
            ],
            [
                'name' => 'Rapid Fire Blaster',
                'category' => 'Light Weapon',
                'primary_damage' => 50,
                'primary_type' => 'kinetic',
                'secondary_damage' => 10,
                'secondary_type' => 'explosive',
                'range' => 60,
                'accuracy' => 85,
                'cooldown' => 1,
                'special_ability' => 'Overdrive - Fires twice in a single round with a 25% accuracy reduction.',
                'description' => 'A high-rate-of-fire blaster that excels in close-range skirmishes, providing rapid kinetic bursts with an added explosive punch.',
            ],
            [
                'name' => 'Arc Disruptor Beam',
                'category' => 'Medium Weapon',
                'primary_damage' => 80,
                'primary_type' => 'electronic',
                'secondary_damage' => 20,
                'secondary_type' => 'energy',
                'range' => 80,
                'accuracy' => 87,
                'cooldown' => 2,
                'special_ability' => 'EMP Shock - Reduces the target’s shield strength by 15% for two rounds.',
                'description' => 'Emits a concentrated electronic pulse capable of disrupting shield generators and energy systems, effective for weakening enemy defenses.',
            ],
            [
                'name' => 'Sonic Lance',
                'category' => 'Medium Weapon',
                'primary_damage' => 90,
                'primary_type' => 'kinetic',
                'secondary_damage' => 20,
                'secondary_type' => 'corrosive',
                'range' => 70,
                'accuracy' => 82,
                'cooldown' => 2,
                'special_ability' => 'Armor Crack - Decreases target armor effectiveness by 10% for one turn.',
                'description' => 'Utilizing focused kinetic blasts, this weapon is capable of cracking armor with each hit, suitable for rapid offensive maneuvers.',
            ],
            [
                'name' => 'Vapor Missile Pod',
                'category' => 'Medium Weapon',
                'primary_damage' => 100,
                'primary_type' => 'explosive',
                'secondary_damage' => 30,
                'secondary_type' => 'kinetic',
                'range' => 85,
                'accuracy' => 80,
                'cooldown' => 3,
                'special_ability' => 'Flare Impact - Temporarily blinds the target, reducing its accuracy by 15% for the next round.',
                'description' => 'A missile system designed for hit-and-run tactics, releasing high-impact explosives capable of destabilizing enemy positioning.',
            ],
            [
                'name' => 'Laser Lance Array',
                'category' => 'Heavy Weapon',
                'primary_damage' => 120,
                'primary_type' => 'energy',
                'secondary_damage' => 25,
                'secondary_type' => 'electronic',
                'range' => 95,
                'accuracy' => 83,
                'cooldown' => 3,
                'special_ability' => 'Beam Focus - Reduces cooldown by 1 round if the previous hit was a critical strike.',
                'description' => 'This laser array channels concentrated beams for maximum impact over extended range, ideal for dismantling targets with high precision.',
            ],
            [
                'name' => 'Shrapnel Scatter Cannon',
                'category' => 'Light Weapon',
                'primary_damage' => 70,
                'primary_type' => 'kinetic',
                'secondary_damage' => 20,
                'secondary_type' => 'explosive',
                'range' => 55,
                'accuracy' => 88,
                'cooldown' => 1,
                'special_ability' => 'Area Suppression - Reduces target evasion by 10% for 2 rounds.',
                'description' => 'This rapid-fire cannon scatters kinetic shrapnel over a wide area, disrupting multiple targets and reducing their evasive capabilities.',
            ],
        ];

        foreach ($modules as $module) {
            // Create the base entry in the `modules` table
            $baseModule = Module::create([
                'name' => $module['name'],
                'type' => 'weapon',
                'mega_corporation_id' => MegaCorporation::where('name', 'Stellar Dynamics')->first()->id,
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
