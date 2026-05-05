<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\User\Home;
use App\Livewire\User\RegistrationWizard;

Route::get('/', Home::class)->name('home');
Route::get('/register', RegistrationWizard::class)->name('register');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
