<?php

namespace App\Livewire;

use App\Events\TestEvent;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class ReverbTest extends Component
{
    public function render()
    {
        return view('livewire.reverb-test');
    }

    public function test()
    {

        TestEvent::dispatch();

        Flux::toast('Event dispatched');
    }

    #[On('echo:test-channel,TestEvent')]
    public function notifyIfTest()
    {
        Flux::toast('Your changes have been saved.');

    }
}
