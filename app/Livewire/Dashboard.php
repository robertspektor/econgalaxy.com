<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public array $openApps = [];

    public array $apps = [
        [
            'name' => 'profileManager',
            'label' => 'Profile Manager',
            'component' => 'apps.profile-manager',
            'opened' => false,
            'minimized' => false,
        ],
        [
            'name' => 'companyDashboard',
            'label' => 'Company Dashboard',
            'component' => 'apps.company-dashboard',
            'opened' => false,
            'minimized' => false,
        ],
        [
            'name' => 'employeeManager',
            'label' => 'Employee Manager',
            'component' => 'apps.employee-manager',
            'opened' => false,
            'minimized' => false,
        ],
        [
            'name' => 'projectManager',
            'label' => 'Project Manager',
            'component' => 'apps.project-manager',
            'opened' => false,
            'minimized' => false,
        ],
    ];

    protected $listeners = [
        'window:close' => 'closeApp',
        'window:minimize' => 'minimizeApp',
        'shutdown:complete' => 'completeShutdown',
    ];

    public function openApp(string $name)
    {
        foreach ($this->apps as &$app) {
            if ($app['name'] === $name) {
                $app['opened'] = true;
                $app['minimized'] = false;
            }
        }
    }

    public function closeApp(array $event)
    {
        $name = $event['name'] ?? null;
        if (!$name) {
            \Log::error("Close event missing name: " . json_encode($event));
            return;
        }

        \Log::info("Closing app: {$name}");
        foreach ($this->apps as &$app) {
            if ($app['name'] === $name) {
                $app['opened'] = false;
                $app['minimized'] = false;
                \Log::info("App closed: {$name}, State: " . json_encode($app));
                break;
            }
        }
    }

    public function minimizeApp(array $event)
    {
        $name = $event['name'] ?? null;
        if (!$name) {
            \Log::error("Minimize event missing name: " . json_encode($event));
            return;
        }

        foreach ($this->apps as &$app) {
            if ($app['name'] === $name && $app['opened']) {
                $app['minimized'] = true;
            }
        }
    }

    public function completeShutdown()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->redirect(route('login', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
