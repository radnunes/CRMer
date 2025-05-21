<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware(['auth', 'verified'])->group(function () {

    // Home/Dashboard
    Route::view('/', 'dashboard')->name('dashboard');

    Route::prefix('teams')->middleware(['auth', 'verified'])->group(function () {
        Route::view('/', 'teams')->name('teams');
    });

    // Settings
    Route::prefix('settings')->as('settings.')->group(function () {
        Route::redirect('/', 'settings/profile');
        Volt::route('profile', 'settings.profile')->name('profile');
        Volt::route('password', 'settings.password')->name('password');
        Volt::route('appearance', 'settings.appearance')->name('appearance');
    });
});

require __DIR__.'/auth.php';
