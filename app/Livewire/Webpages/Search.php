<?php

namespace App\Livewire\Webpages;

use Livewire\Component;

class Search extends Component
{
    public $query;

    public function mount($query)
    {
        $this->query = $query;
    }

    public function render()
    {
        return view('livewire.webpages.search');
    }
}
