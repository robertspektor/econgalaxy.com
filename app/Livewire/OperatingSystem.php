<?php
namespace App\Livewire;

use App\Models\AppState;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OperatingSystem extends Component
{
    public array $openApps = [];
    public $currentLocationLabel;

    public array $apps = [
        [
            'name' => 'profileManager',
            'label' => 'Profile Manager',
            'component' => 'apps.profile-manager',
            'opened' => false,
            'minimized' => false,
            'position' => ['x' => 50, 'y' => 50],
            'size' => ['width' => 800, 'height' => 600],
        ],
        [
            'name' => 'companyDashboard',
            'label' => 'Company Dashboard',
            'component' => 'apps.company-dashboard',
            'opened' => false,
            'minimized' => false,
            'position' => ['x' => 100, 'y' => 100],
            'size' => ['width' => 800, 'height' => 600],
        ],
        [
            'name' => 'employeeManager',
            'label' => 'Employee Manager',
            'component' => 'apps.employee-manager',
            'opened' => false,
            'minimized' => false,
            'position' => ['x' => 150, 'y' => 150],
            'size' => ['width' => 800, 'height' => 600],
        ],
        [
            'name' => 'projectManager',
            'label' => 'Project Manager',
            'component' => 'apps.project-manager',
            'opened' => false,
            'minimized' => false,
            'position' => ['x' => 200, 'y' => 200],
            'size' => ['width' => 800, 'height' => 600],
        ],
        [
            'name' => 'galacticCommunicator',
            'label' => 'Galactic Communicator',
            'component' => 'apps.galactic-communicator',
            'opened' => false,
            'minimized' => false,
            'position' => ['x' => 250, 'y' => 250],
            'size' => ['width' => 800, 'height' => 600],
        ],
        [
            'name' => 'stellarBrowser',
            'label' => 'StellarBrowser',
            'component' => 'apps.stellar-browser',
            'opened' => false,
            'minimized' => false,
            'position' => ['x' => 300, 'y' => 300],
            'size' => ['width' => 800, 'height' => 600],
        ],
        [
            'name' => 'galaxyMap',
            'label' => 'Galaxy Map',
            'component' => 'apps.galaxy-map-app',
            'opened' => false,
            'minimized' => false,
            'position' => ['x' => 350, 'y' => 350],
            'size' => ['width' => 800, 'height' => 600],
        ],
    ];

    protected $listeners = [
        'window:close' => 'closeApp',
        'window:minimize' => 'minimizeApp',
        'window:resize' => 'resizeApp',
        'window:move' => 'moveApp',
        'shutdown:complete' => 'completeShutdown',
        'openApp' => 'openApp',
        'location-updated' => 'updateLocationLabel',
    ];

    public function mount()
    {
        $userId = Auth::id();
        $appStates = AppState::where('user_id', $userId)->get()->keyBy('app_name');

        foreach ($this->apps as $key => &$app) {
            $appState = $appStates[$app['name']] ?? null;
            if ($appState) {
                $app['opened'] = $appState->opened;
                $app['minimized'] = $appState->minimized;
                $app['position'] = $appState->position;
                $app['size'] = $appState->size;
            } else {
                $app['position'] = $app['position'] ?? ['x' => 50, 'y' => 50];
                $app['size'] = $app['size'] ?? ['width' => 800, 'height' => 600];
            }
            $this->apps[$key] = $app;
        }

        $this->currentLocationLabel = auth()->user()->location_label;
    }

    public function updateLocationLabel()
    {
        $this->currentLocationLabel = auth()->user()->location_label;
        $this->dispatch('location-changed'); // Event für Alpine.js
    }

    public function openApp(string $name)
    {
        $userId = Auth::id();
        foreach ($this->apps as &$app) {
            if ($app['name'] === $name) {
                $app['opened'] = true;
                $app['minimized'] = false;
                $app['position'] = $app['position'] ?? ['x' => 50, 'y' => 50];
                $app['size'] = $app['size'] ?? ['width' => 800, 'height' => 600];

                AppState::updateOrCreate(
                    ['user_id' => $userId, 'app_name' => $name],
                    [
                        'opened' => $app['opened'],
                        'minimized' => $app['minimized'],
                        'position' => $app['position'],
                        'size' => $app['size'],
                    ]
                );

                \Log::info("App opened: {$name}, State: " . json_encode($app));
                break;
            }
        }
    }

    public function closeApp(string $name)
    {
        $userId = Auth::id();
        \Log::info("Closing app: {$name}");
        foreach ($this->apps as &$app) {
            if ($app['name'] === $name) {
                $app['opened'] = false;
                $app['minimized'] = false;

                AppState::updateOrCreate(
                    ['user_id' => $userId, 'app_name' => $name],
                    [
                        'opened' => $app['opened'],
                        'minimized' => $app['minimized'],
                        'position' => $app['position'],
                        'size' => $app['size'],
                    ]
                );

                \Log::info("App closed: {$name}, State: " . json_encode($app));
                break;
            }
        }
    }

    public function minimizeApp(string $name)
    {
        $userId = Auth::id();
        foreach ($this->apps as &$app) {
            if ($app['name'] === $name && $app['opened']) {
                $app['minimized'] = true;

                AppState::updateOrCreate(
                    ['user_id' => $userId, 'app_name' => $name],
                    [
                        'opened' => $app['opened'],
                        'minimized' => $app['minimized'],
                        'position' => $app['position'],
                        'size' => $app['size'],
                    ]
                );

                \Log::info("App minimized: {$name}, State: " . json_encode($app));
                break;
            }
        }
    }

    public function resizeApp(string $name, int $width, int $height)
    {
        $userId = Auth::id();
        \Log::info("Received resize event for app: {$name}, New size: width={$width}, height={$height}");
        foreach ($this->apps as &$app) {
            if ($app['name'] === $name) {
                $app['size'] = [
                    'width' => $width,
                    'height' => $height,
                ];

                AppState::updateOrCreate(
                    ['user_id' => $userId, 'app_name' => $name],
                    [
                        'opened' => $app['opened'],
                        'minimized' => $app['minimized'],
                        'position' => $app['position'],
                        'size' => $app['size'],
                    ]
                );

                \Log::info("App resized: {$name}, Size: " . json_encode($app['size']));
                break;
            }
        }
    }

    public function moveApp(string $name, int $x, int $y)
    {
        $userId = Auth::id();
        \Log::info("Received move event for app: {$name}, New position: x={$x}, y={$y}");
        foreach ($this->apps as &$app) {
            if ($app['name'] === $name) {
                $app['position'] = [
                    'x' => $x,
                    'y' => $y,
                ];

                AppState::updateOrCreate(
                    ['user_id' => $userId, 'app_name' => $name],
                    [
                        'opened' => $app['opened'],
                        'minimized' => $app['minimized'],
                        'position' => $app['position'],
                        'size' => $app['size'],
                    ]
                );

                \Log::info("App moved: {$name}, Position: " . json_encode($app['position']));
                break;
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
        return view('livewire.operating-system');
    }
}
