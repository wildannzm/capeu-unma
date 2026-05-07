<?php

use App\Http\Controllers\DocumentController;
use App\Livewire\Login;
use App\Livewire\User\Dashboard;
use App\Livewire\User\Home;
use App\Livewire\User\Profile;
use App\Livewire\User\RegistrationWizard;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/login', Login::class)->name('login');
Route::get('/register', RegistrationWizard::class)->name('register');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/documents/{registration}/{field}', [DocumentController::class, 'show'])->name('documents.show');
});
