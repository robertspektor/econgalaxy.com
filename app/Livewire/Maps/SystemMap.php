<?php

namespace App\Livewire\Maps;

use App\Models\System;
use Illuminate\Support\Collection;
use Livewire\Component;

class SystemMap extends Component
{
    public System $system;

    public Collection $sectors;

    public Collection $planets;

    public Collection $moons;

    public Collection $fleets;

    public function mount(System $system)
    {
        $this->system = $system;
        $this->sectors = $system->sectors;
        $this->planets = $system->planets;
        $this->moons = $system->planets->map(function ($planet) {
            return $planet->moons;
        })->flatten();

        // get all fleets in this system
        $this->fleets = $system->fleets;

        // add size and isFriendly to fleets
        $this->fleets->each(function ($fleet) {
            // $fleet->size = $fleet->ships->count();
            $fleet->size = 10;
            $fleet->isFriendly = $fleet->company && $fleet->company->id === auth()->user()->company->id;
        });
    }
    public function render()
    {
        return view('livewire.maps.system-map');
    }
}
