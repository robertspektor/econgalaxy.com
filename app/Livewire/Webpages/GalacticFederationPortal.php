<?php

namespace App\Livewire\Webpages;

use Livewire\Component;
use App\Models\Company;

class GalacticFederationPortal extends Component
{
    public $companyName = '';
    public $companyType = '';
    public $isSubmitted = false;

    protected $rules = [
        'companyName' => 'required|string|max:255',
        'companyType' => 'required|in:Freelancer,Corporation,Cooperative',
    ];

    public function submitApplication()
    {
        $this->validate();

        Company::create([
            'user_id' => auth()->id(),
            'name' => $this->companyName,
            'type' => $this->companyType,
            'credits' => 100,
        ]);

        $this->isSubmitted = true;
    }

    public function render()
    {
        return view('livewire.webpages.galactic-federation-portal');
    }
}
