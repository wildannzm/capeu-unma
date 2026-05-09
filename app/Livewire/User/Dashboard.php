<?php

namespace App\Livewire\User;

use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.sidebar', ['header' => 'Participant Dashboard'])]
#[Title('CAPEU 2026 - Participant Dashboard')]
class Dashboard extends Component
{
    /**
     * Get the user's registration.
     */
    #[Computed]
    public function registration(): ?Registration
    {
        return Auth::user()->registrations()
            ->with(['payments'])
            ->select(['id', 'user_id', 'registration_number', 'status', 'participant_type', 'passport_path', 'student_card_path', 'formal_photo_path', 'cv_path', 'motivation_letter_path', 'created_at'])
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
