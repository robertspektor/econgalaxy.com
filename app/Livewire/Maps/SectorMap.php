<?php

namespace App\Livewire\Maps;

use App\Models\JumpGate;
use App\Models\Sector;
use Livewire\Component;

class SectorMap extends Component
{
    public function render()
    {
        $sectors = Sector::with('faction')
            ->get();

        $jumpGates = JumpGate::all();

        return view('livewire.maps.sector-map', compact('sectors', 'jumpGates'));
    }
}
