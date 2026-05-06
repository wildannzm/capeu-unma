<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $this->remember)) {
            session()->regenerate();
            
            $this->dispatch('swal:success', [
                'title' => 'Success!',
                'text' => 'Login successful. Redirecting...',
                'url' => route('dashboard')
            ]);
            return;
        }

        $this->addError('email', trans('auth.failed'));
        
        $this->dispatch('swal:error', [
            'title' => 'Login Failed',
            'text' => trans('auth.failed')
        ]);
    }

    #[Layout('layouts.guest')]
    #[Title('Login - CAPEU 2026')]
    public function render()
    {
        return view('livewire.login');
    }
}
