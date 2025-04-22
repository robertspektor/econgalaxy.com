<?php

namespace App\Livewire\Apps;

use App\Models\System;
use Livewire\Component;

class GalaxyMapApp extends Component
{
    public $id;
    public $app;
    public $viewMode = 'galaxy';
    public $selectedSystem = null;

    protected $listeners = [
        'switchToSystem' => 'switchToSystem',
        'switchToGalaxy' => 'switchToGalaxy',
    ];

    public function mount($id, $app)
    {
        $this->id = $id;
        $this->app = $app;

        // Set initial system based on player's location
        $this->initializeFromPlayerLocation();
    }

    protected function initializeFromPlayerLocation()
    {
        $location = auth()->user()->location;
        if (!$location) return;

        $this->viewMode = 'system';

        switch (auth()->user()->location_type) {
            case 'system':
                $this->selectedSystem = $location;
                break;
            case 'planet':
                $this->selectedSystem = $location->system;
                break;
            case 'moon':
                $this->selectedSystem = $location->planet->system;
                break;
        }
    }

    public function switchToGalaxy()
    {
        $this->viewMode = 'galaxy';
        $this->selectedSystem = null;
    }

    public function switchToSystem($systemId)
    {
        $this->viewMode = 'system';
        $this->selectedSystem = System::findOrFail($systemId);
    }

    public function render()
    {
        $systems = System::all();
        $currentSystemId = auth()->user()->location->system_id ?? null;

        $systemsData = $systems->map(function ($system) use ($currentSystemId) {
            return [
                'id' => $system->id,
                'name' => $system->name,
                'gridX' => $system->x,
                'gridY' => $system->y,
                'num_planets' => $system->num_planets,
                'isCurrentSystem' => $system->id === $currentSystemId,
            ];
        })->toArray();

        $systemMapData = [];
        if ($this->viewMode === 'system' && $this->selectedSystem) {
            $systemMapData = $this->prepareSystemMapData($this->selectedSystem);
        }

        $currentSystem = System::find($currentSystemId);
        $initialCenter = [
            'gridX' => $currentSystem?->x ?? 0,
            'gridY' => $currentSystem?->y ?? 0,
        ];

        return view('livewire.apps.galaxy-map-app', [
            'systemsData' => $systemsData,
            'fleets' => $this->getFleets($systems),
            'initialCenter' => $initialCenter,
            'systemMapData' => $systemMapData,
            'playerLocation' => [
                'type' => auth()->user()->location_type,
                'id' => auth()->user()->location_id,
            ],
        ]);
    }

    protected function prepareSystemMapData($system)
    {
        return [
            'system' => $system,
            'sectors' => $system->sectors,
            'planets' => $system->planets,
            'moons' => $system->planets->map(fn($planet) => $planet->moons)->flatten(),
            'fleets' => $system->fleets->map(function ($fleet) {
                $fleet->size = 10;
                $fleet->isFriendly = $fleet->company && $fleet->company->id === auth()->user()->company->id;
                return $fleet;
            }),
        ];
    }

    protected function getFleets($systems)
    {
        return $systems->map(function ($system) {
            return $system->fleets->map(function ($fleet) {
                $fleet->size = 10;
                $fleet->isFriendly = $fleet->company && $fleet->company->id === auth()->user()->company->id;
                return $fleet;
            });
        })->flatten();
    }
}
