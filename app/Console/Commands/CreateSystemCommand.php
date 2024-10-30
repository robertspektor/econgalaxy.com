<?php

namespace App\Console\Commands;

use App\Models\Moon;
use App\Models\Planet;
use App\Models\Sector;
use App\Models\System;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateSystemCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-system-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new system with planets and moons';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->truncate();

        // create new System
        $system = new System();

        // get system name from /system_names.json
        $systemNames = collect(json_decode(file_get_contents(base_path('system_names.json')), true));

        $system->name = $systemNames->random()['name'];
        $system->num_planets = rand(1, 5);

        $system->save();

        $system->sectors()->createMany($system->calculateSectorsForSystem(
            $system->num_planets
        ));

        $system->planets()->createMany($system->calculatePlanetsForSystem(
            $system->num_planets
        ));

        $system->planets->each(function (Planet $planet) {
            $planet->moons()->createMany($planet->calculateMoonsForPlanet());
        });

    }

    private function truncate()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Moon::truncate();
        Planet::truncate();
        Sector::truncate();
        System::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
