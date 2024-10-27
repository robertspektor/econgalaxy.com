<?php

namespace App\Livewire\Pages;

use App\Models\Sector;
use Livewire\Component;

class ShowSectorPage extends Component
{
    public ?Sector $sector = null;

    public function mount(Sector $sector): void
    {
        $this->sector = $sector;
    }

    public function render()
    {
        return view('livewire.pages.show-sector-page');
    }
}
