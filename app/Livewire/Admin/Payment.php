<?php

namespace App\Livewire\Admin;

use App\Models\Payment as PaymentModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.sidebar', ['header' => 'Manage Payments'])]
#[Title('Payments - CAPEU 2026')]
class Payment extends Component
{
    public string $search = '';

    public string $statusFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];

    public function updatingSearch() {}

    public function updateStatus(int $id, string $status)
    {
        $payment = PaymentModel::findOrFail($id);

        $updateData = ['status' => $status];

        if ($status === 'verified') {
            $updateData['verified_by'] = Auth::id();
            $updateData['verified_at'] = now();

            // Also update the associated registration status if needed
            $payment->registration->update(['status' => 'payment_verified']);
        }

        if ($status === 'rejected') {
            // If payment is rejected, the registration is also rejected
            $payment->registration->update(['status' => 'rejected']);
        }

        $payment->update($updateData);

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Payment status updated to '.str_replace('_', ' ', $status),
        ]);
    }

    public function render()
    {
        $payments = PaymentModel::with(['registration.user', 'verifier'])
            ->when($this->search, function ($query) {
                $query->whereHas('registration.user', function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->latest()
            ->get();

        return view('livewire.admin.payment', [
            'payments' => $payments,
        ]);
    }
}
