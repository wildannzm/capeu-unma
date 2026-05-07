<?php

namespace App\Livewire\User;

use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.sidebar', ['header' => 'Participant Dashboard'])]
#[Title('CAPEU 2026 - Participant Dashboard')]
class Dashboard extends Component
{
    /**
     * The user's registration.
     */
    public ?Registration $registration = null;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->registration = Auth::user()->registrations()
            ->with(['payments'])
            ->latest()
            ->first();
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('livewire.user.dashboard');
    }
}
