<?php

namespace App\Livewire\Admin;

use App\Models\Payment;
use App\Models\Registration;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.sidebar', ['header' => 'Admin Dashboard'])]
#[Title('CAPEU 2026 - Admin Dashboard')]
class Dashboard extends Component
{
    public int $totalRegistrations = 0;

    public int $pendingPayments = 0;

    public int $totalUsers = 0;

    public float $totalVerifiedAmount = 0;

    public $recentPayments;

    public function mount()
    {
        $this->totalRegistrations = Registration::count();
        // Count registrations that need either payment verification (submitted) or document verification (payment_verified)
        $this->pendingPayments = Registration::whereIn('status', ['submitted', 'payment_verified'])->count();
        // Count only registrants who have been fully accepted
        $this->totalUsers = Registration::where('status', 'accepted')->count();
        $this->totalVerifiedAmount = (float) Payment::where('status', 'verified')->sum('amount');

        $this->recentPayments = Payment::with(['registration.user'])
            ->latest()
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
