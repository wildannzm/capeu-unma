<?php

namespace App\Livewire\Admin;

use App\Models\Registration as RegistrationModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.sidebar', ['header' => 'Manage Registrations'])]
#[Title('Registrations - CAPEU 2026')]
class Registration extends Component
{
    use WithPagination;

    public string $search = '';

    public string $statusFilter = '';

    public ?RegistrationModel $selectedRegistration = null;

    public bool $showDetailModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function viewDetails(int $id)
    {
        $this->selectedRegistration = RegistrationModel::with('user')->findOrFail($id);
        $this->showDetailModal = true;
    }

    public function updateStatus(int $id, string $status)
    {
        $registration = RegistrationModel::findOrFail($id);
        $registration->update(['status' => $status]);

        if ($this->selectedRegistration && $this->selectedRegistration->id === $id) {
            $this->selectedRegistration->refresh();
        }

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Registration status updated to '.str_replace('_', ' ', $status),
        ]);
    }

    public function closeModal()
    {
        $this->showDetailModal = false;
        $this->selectedRegistration = null;
    }

    public function render()
    {
        $registrations = RegistrationModel::with('user')
            ->when($this->search, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.registration', [
            'registrations' => $registrations,
        ]);
    }
}
