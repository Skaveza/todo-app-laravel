<?php

use App\Http\Controllers\TodoController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', fn () => redirect()->route('todos.index'))->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Settings routes from Livewire/Fortify
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(
                        Features::twoFactorAuthentication(),
                        'confirmPassword'
                    ),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    // Auth-protected TO-DO routes
    Route::resource('todos', TodoController::class)->except(['show']);
    Route::patch('todos/{todo}/complete', [TodoController::class, 'complete'])
        ->name('todos.complete');
});
