<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\BootScreen;
use App\Livewire\OperatingSystem;
use App\Livewire\Pages\System\ShowSystemPage;
use App\Livewire\Pages\Galaxy\Index as GalaxyIndex;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])
    ->group(function () {
        // Boot-Screen nach dem Login
        Route::get('/boot', BootScreen::class)
            ->name('boot');

        // Haupt-OS-Seite
        Route::get('/os', OperatingSystem::class)
            ->name('os');

        // System-Details
        Route::get('systems/{system}', ShowSystemPage::class)
            ->name('systems.show');

        // Galaxy-Übersicht
        Route::get('galaxy', GalaxyIndex::class)
            ->name('galaxy.index');

        // Profil-Seite
        Route::view('profile', 'profile')
            ->name('profile');
    });

require __DIR__ . '/auth.php';
