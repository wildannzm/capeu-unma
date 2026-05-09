<?php

namespace App\Livewire\Admin;

use App\Models\Payment as PaymentModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.sidebar', ['header' => 'Manage Payments'])]
#[Title('Payments - CAPEU 2026')]
class Payment extends Component
{
    use WithPagination;

    public string $search = '';

    public string $statusFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updateStatus(int $id, string $status)
    {
        $payment = PaymentModel::findOrFail($id);
        
        $updateData = ['status' => $status];
        
        if ($status === 'verified') {
            $updateData['verified_by'] = auth()->id();
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
            ->paginate(10);

        return view('livewire.admin.payment', [
            'payments' => $payments,
        ]);
    }
}
