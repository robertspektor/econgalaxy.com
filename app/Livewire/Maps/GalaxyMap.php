<?php

namespace App\Livewire\Maps;

use App\Models\JumpGate;
use App\Models\Sector;
use App\Models\System;
use Livewire\Component;

class GalaxyMap extends Component
{
    public function render()
    {
        $systems = System::all();

        // get all fleets in this system
        $fleets = $systems->map(function ($system) {
            return $system->fleets;
        })->flatten();

        // add size and isFriendly to fleets
        $fleets->each(function ($fleet) {
            // $fleet->size = $fleet->ships->count();
            $fleet->size = 10;
            $fleet->isFriendly = $fleet->company && $fleet->company->id === auth()->user()->company->id;
        });

        $spaceports = [
            [
                'name' => 'Spaceport 1',
                'system' => 'Sol',
                'x' => 100,
                'y' => 100,
            ],
            [
                'name' => 'Spaceport 2',
                'system' => 'Sol',
                'x' => 200,
                'y' => 200,
            ],
            [
                'name' => 'Spaceport 3',
                'system' => 'Sol',
                'x' => 300,
                'y' => 300,
            ]
        ];

        return view('livewire.maps.galaxy-map', compact('systems', 'fleets', 'spaceports'));
    }
}
