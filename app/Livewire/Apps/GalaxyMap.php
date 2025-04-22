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
        $currentSystemId = auth()->user()->location->system_id ?? null;

        $this->systemsData = $systems->map(function ($system) use ($currentSystemId) {
            return [
                'id' => $system->id,
                'name' => $system->name,
                'gridX' => $system->x,
                'gridY' => $system->y,
                'num_planets' => $system->num_planets,
                'isCurrentSystem' => $system->id === $currentSystemId,
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

        // Initial center based on player's location
        $currentSystem = System::find($currentSystemId);
        $this->initialCenter = [
            'gridX' => $currentSystem?->x ?? 0,
            'gridY' => $currentSystem?->y ?? 0,
        ];

        $this->playerLocation = [
            'type' => auth()->user()->location_type,
            'id' => auth()->user()->location_id,
        ];
    }

    public function render()
    {
        return view('livewire.apps.galaxy-map');
    }
}
