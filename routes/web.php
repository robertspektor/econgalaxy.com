<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//Route::get('sectors/{sector}', \App\Livewire\Pages\ShowSectorPage::class)
//    ->middleware(['auth'])
//    ->name('sectors.show');

Route::get('systems/{system}', \App\Livewire\Pages\System\ShowSystemPage::class)
    ->middleware(['auth'])
    ->name('systems.show');

Route::get('galaxy', \App\Livewire\Pages\Galaxy\Index::class)
    ->middleware(['auth'])
    ->name('galaxy.index');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
