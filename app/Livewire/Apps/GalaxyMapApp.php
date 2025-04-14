<?php

namespace App\Livewire\Apps;

use App\Models\JumpGate;
use App\Models\Sector;
use App\Models\System;
use Livewire\Component;

class GalaxyMapApp extends Component
{
    public $id;
    public $app;
    public $viewMode = 'galaxy'; // 'galaxy' or 'system'
    public $selectedSystem = null;

    public function mount($id, $app)
    {
        $this->id = $id;
        $this->app = $app;

        // Optionally set the initial system to the player's current location
        if (auth()->user()->location_type === 'system') {
            $this->viewMode = 'system';
            $this->selectedSystem = auth()->user()->location;
        } elseif (auth()->user()->location_type === 'planet') {
            $this->viewMode = 'system';
            $this->selectedSystem = auth()->user()->location->system;
        } elseif (auth()->user()->location_type === 'moon') {
            $this->viewMode = 'system';
            $this->selectedSystem = auth()->user()->location->planet->system;
        }
    }

    public function switchToGalaxy()
    {
        \Log::info('Switching to Galaxy View');
        $this->viewMode = 'galaxy';
        $this->selectedSystem = null;
        $this->dispatch('render-map', viewMode: $this->viewMode);
    }

    public function switchToSystem($systemId)
    {
        \Log::info('Switching to System View for system ID:', ['systemId' => $systemId]);
        $this->viewMode = 'system';
        $this->selectedSystem = System::findOrFail($systemId);
        \Log::info('Selected System Updated:', ['selectedSystem' => $this->selectedSystem->toArray()]);
        // Force a re-render to update systemMapData before dispatching the event
        $this->render();
        $this->dispatch('render-map', viewMode: $this->viewMode);
    }

    public function render()
    {
        // Fetch systems
        $systems = System::all();
        $systemsData = $systems->map(function ($system) {
            return [
                'id' => $system->id,
                'name' => $system->name,
                'gridX' => $system->x,
                'gridY' => $system->y,
                'num_planets' => $system->num_planets,
            ];
        })->toArray();

        $initialCenter = [
            'gridX' => auth()->user()->coordinates['x'] ?? 0,
            'gridY' => auth()->user()->coordinates['y'] ?? 0,
        ];

        // Prepare systemMapData for System View
        $systemMapData = [];
        if ($this->viewMode === 'system' && $this->selectedSystem) {
            $system = $this->selectedSystem;
            $sectors = $system->sectors;
            $planets = $system->planets;
            $moons = $system->planets->map(function ($planet) {
                return $planet->moons;
            })->flatten();

            $fleets = $system->fleets;
            $fleets->each(function ($fleet) {
                $fleet->size = 10;
                $fleet->isFriendly = $fleet->company && $fleet->company->id === auth()->user()->company->id;
            });

            $systemMapData = [
                'system' => $system,
                'sectors' => $sectors,
                'planets' => $planets,
                'moons' => $moons,
                'fleets' => $fleets,
            ];
        }

        // Fetch fleets for Galaxy View
        $fleets = $systems->map(function ($system) {
            return $system->fleets;
        })->flatten();
        $fleets->each(function ($fleet) {
            $fleet->size = 10;
            $fleet->isFriendly = $fleet->company && $fleet->company->id === auth()->user()->company->id;
        });

        $spaceports = [
            ['name' => 'Spaceport 1', 'system' => 'Sol', 'x' => 100, 'y' => 100],
            ['name' => 'Spaceport 2', 'system' => 'Sol', 'x' => 200, 'y' => 200],
            ['name' => 'Spaceport 3', 'system' => 'Sol', 'x' => 300, 'y' => 300]
        ];

        \Log::info('GalaxyMapApp rendering', [
            'viewMode' => $this->viewMode,
            'systemsData' => $systemsData,
            'selectedSystem' => $this->selectedSystem ? $this->selectedSystem->toArray() : null,
            'systemMapData' => $systemMapData,
            'initialCenter' => $initialCenter,
        ]);

        return view('livewire.apps.galaxy-map-app', [
            'systemsData' => $systemsData,
            'fleets' => $fleets,
            'spaceports' => $spaceports,
            'initialCenter' => $initialCenter,
            'systemMapData' => $systemMapData,
        ]);
    }
}
