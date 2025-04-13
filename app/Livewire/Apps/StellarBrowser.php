<?php

namespace App\Livewire\Apps;

use Livewire\Component;

class StellarBrowser extends Component
{
    public $id;
    public $url = '';

    public $app;

    public array $webpages = [
        'galactic-federation-portal' => 'webpages.galactic-federation-portal',
    ];

    public function mount($id, $app)
    {
        $this->id = $id;
        $this->app = $app;

        if (array_key_exists($this->url, $this->webpages)) {
            $this->url = $this->webpages[$this->url];
        } else {
            $this->url = '';
        }
    }

    public function loadPage($url)
    {
        if (array_key_exists($url, $this->webpages)) {
            $this->url = $url;
        } else {
            $this->url = '';
        }
    }

    public function render()
    {
        return view('livewire.apps.stellar-browser');
    }
}
