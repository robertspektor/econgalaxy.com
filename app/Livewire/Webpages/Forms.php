<?php

namespace App\Livewire\Webpages;

use Livewire\Component;
use App\Models\Company;

class Forms extends Component
{
    public $companyName = '';
    public $faction = '';
    public $description = '';
    public $isSubmitted = false;

    protected $rules = [
        'companyName' => 'required|string|max:255',
        'faction' => 'required|in:Galactic Federation,Rebel Alliance',
        'description' => 'required|string|max:1000',
    ];

    public function submitApplication()
    {
        $this->validate();

        Company::create([
            'user_id' => auth()->id(),
            'name' => $this->companyName,
            'type' => 'Freelancer', // Standardwert, kann später angepasst werden
            'faction' => $this->faction,
            'description' => $this->description,
            'credits' => 100,
        ]);

        $this->isSubmitted = true;
    }

    public function render()
    {
        return view('livewire.webpages.forms');
    }
}
