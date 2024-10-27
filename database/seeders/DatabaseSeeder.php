<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            FactionSeeder::class,
            SectorsTableSeeder::class,
            JumpGatesTableSeeder::class,
            MegaCorporationSeeder::class,
            EchoCovertWeaponSeeder::class,
            UnionDefenseWeaponSeeder::class,
            StellarDynamicsWeaponModuleSeeder::class,
            PropulsionModuleSeeder::class,
            PeregrineRoboticsWeaponSeeder::class,
            HammerheadIndustriesWeaponSeeder::class,
            PlayerOriginSeeder::class,
        ]);
    }
}
