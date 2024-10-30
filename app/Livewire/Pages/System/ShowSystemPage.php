<?php

namespace App\Livewire\Pages\System;

use App\Models\System;
use Livewire\Component;

class ShowSystemPage extends Component
{
    public System $system;

    public function mount(System $system)
    {
        $this->system = $system;
    }

    public function render()
    {
        return view('livewire.pages.system.show-system-page');
    }
}
