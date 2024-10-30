<?php

namespace App\Listeners;

use App\Events\CompanyCreated;
use App\Models\System;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateStarterShip
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CompanyCreated $event): void
    {
        // get company
        $company = $event->company
            ->with('user')
            ->first();

        // get player_origin from company.user.player_origin
        $playerOrigin = $company->user->playerOrigin()->first();

        // looking for startet system
        // TODO: implement this
        // random system
        $system = System::inRandomOrder()->first();

        $randomSector = $system->sectors()->inRandomOrder()->first();

        // create fleet
        $fleet = $event->company->fleets()->create([
            'name' => 'Starter Fleet',
            'system_id' => $system->id,
            'current_sector_id' => $randomSector->id,
        ]);

        dd($fleet);

        // Create a starter ship for the company
        $event->company->ships()->create([
            'name' => 'Starter Ship',
            'type' => 'starter',
            'health' => 100,
            'speed' => 100,
            'damage' => 10,
        ]);
    }
}
