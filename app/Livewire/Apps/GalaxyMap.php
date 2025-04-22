<?php

namespace App\Livewire\Apps;

use App\Models\System;
use Livewire\Component;

class GalaxyMap extends Component
{
    public $systemsData;
    public $fleets;
    public $initialCenter;
    public $playerLocation;

    public function mount()
    {
        // Fetch systems
        $systems = System::all();
        $this->systemsData = $systems->map(function ($system) {
            return [
                'id' => $system->id,
                'name' => $system->name,
                'gridX' => $system->x,
                'gridY' => $system->y,
                'num_planets' => $system->num_planets,
            ];
        })->toArray();

        // Fetch fleets
        $this->fleets = $systems->map(function ($system) {
            return $system->fleets;
        })->flatten();
        $this->fleets->each(function ($fleet) {
            $fleet->size = 10;
            $fleet->isFriendly = $fleet->company && $fleet->company->id === auth()->user()->company->id;
        });

        // Initial center based on player's coordinates
        $this->initialCenter = [
            'gridX' => auth()->user()->coordinates['x'] ?? 0,
            'gridY' => auth()->user()->coordinates['y'] ?? 0,
        ];

        // Player location
        $this->playerLocation = [
            'type' => auth()->user()->location_type,
            'id' => auth()->user()->location_id,
        ];
    }

    public function render()
    {
        \Log::info('GalaxyMap rendering', [
            'systemsData' => $this->systemsData,
            'fleets' => $this->fleets,
            'initialCenter' => $this->initialCenter,
            'playerLocation' => $this->playerLocation,
        ]);

        return view('livewire.apps.galaxy-map');
    }
}
