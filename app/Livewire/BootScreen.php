<?php

namespace App\Livewire;

use Livewire\Component;

class BootScreen extends Component
{
    public bool $isBooting = true;

    protected $listeners = [
        'boot:complete' => 'completeBoot',
    ];

    public function completeBoot()
    {
        $this->isBooting = false;
        $this->redirect(route('os', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.boot-screen');
    }
}
