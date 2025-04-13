<?php

namespace App\Livewire\Apps;

use Livewire\Component;

class StellarBrowser extends Component
{
    public $id;
    public $app;
    public $url = '';
    public $query = '';
    public $consoleLog = [];
    public $isLoadingContent = true; // Für den Ladeindikator im Inhaltsbereich
    public $latency = 2000; // Standard-Latenz in Millisekunden (wird clientseitig simuliert)

    public array $webpages = [
        'home' => 'webpages.home',
        'factions' => 'webpages.factions',
        'faction' => 'webpages.faction',
        'companies' => 'webpages.companies',
        'company' => 'webpages.company',
        'forms' => 'webpages.forms',
        'news' => 'webpages.news',
        'search' => 'webpages.search',
    ];

    public $currentPage = 'home';
    public $pageParams = [];

    public function mount($id, $app)
    {
        $this->id = $id;
        $this->app = $app;
        $this->url = 'home';
        $this->currentPage = 'home';

        // Simuliere Latenz clientseitig (wird in Alpine.js gesteuert)
        $this->latency = rand(1000, 3000);
        $this->logConsole("GET /intra/home → 200 OK (1.2 KB)");
    }

    public function loadPage($url, $params = [])
    {
        $this->isLoadingContent = true;
        $this->dispatch('content-loading'); // Dispatch ein Event an Alpine.js

        $this->url = $url;
        $this->pageParams = $params;

        if (array_key_exists($url, $this->webpages)) {
            $this->currentPage = $url;
            $this->logConsole("GET /intra/{$url}" . ($params ? '?' . http_build_query($params) : '') . " → 200 OK (1.2 KB)");
        } else {
            $this->currentPage = '';
            $this->logConsole("GET /intra/{$url}" . ($params ? '?' . http_build_query($params) : '') . " → 404 NOT FOUND");
        }
    }

    public function search()
    {
        if ($this->query) {
            $this->loadPage('search', ['query' => $this->query]);
        }
    }

    public function openMailApp($email)
    {
        $this->dispatch('openApp', 'galacticCommunicator');
    }

    protected function logConsole($message)
    {
        $this->consoleLog[] = ['timestamp' => now()->format('Y-m-d H:i:s'), 'message' => $message];
        if (count($this->consoleLog) > 10) {
            array_shift($this->consoleLog);
        }
    }

    public function render()
    {
        return view('livewire.apps.stellar-browser');
    }
}
