<?php

use App\Http\Controllers\DocumentController;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Payment;
use App\Livewire\Admin\Registration;
use App\Livewire\Login;
use App\Livewire\User\Dashboard;
use App\Livewire\User\Home;
use App\Livewire\User\Profile;
use App\Livewire\User\RegistrationWizard;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/login', Login::class)->name('login');
Route::get('/register', RegistrationWizard::class)->name('register')->middleware('throttle:registration');

Route::middleware(['auth:sanctum', config('jetstream.auth_session')])->group(function () {
    Route::get('/documents/{registration}/{field}', [DocumentController::class, 'show'])->name('documents.show');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'role:user'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/payments', Payment::class)->name('payments');
    Route::get('/registrations', Registration::class)->name('registrations');
});
