<?php

namespace App\Livewire\Apps;

use Livewire\Component;

class SystemMap extends Component
{
    public $systemMapData;
    public $playerLocation;

    public function mount($systemMapData, $playerLocation)
    {
        $this->systemMapData = $systemMapData;
        $this->playerLocation = $playerLocation;
    }

    public function render()
    {
        \Log::info('SystemMap rendering', [
            'systemMapData' => $this->systemMapData,
            'playerLocation' => $this->playerLocation,
        ]);

        return view('livewire.apps.system-map');
    }
}
