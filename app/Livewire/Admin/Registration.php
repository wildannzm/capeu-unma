<?php

namespace App\Livewire\Admin;

use App\Exports\RegistrationsExport;
use App\Models\Registration as RegistrationModel;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('layouts.sidebar', ['header' => 'Manage Registrations'])]
#[Title('Registrations - CAPEU 2026')]
class Registration extends Component
{
    use WithPagination;

    public string $search = '';

    public string $statusFilter = '';

    public ?int $selectedRegistrationId = null;

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
        $this->selectedRegistrationId = $id;
        $this->showDetailModal = true;
    }

    #[Computed]
    public function selectedRegistration(): ?RegistrationModel
    {
        if (! $this->selectedRegistrationId) {
            return null;
        }

        return RegistrationModel::with(['user', 'payments'])
            ->findOrFail($this->selectedRegistrationId);
    }

    public function updateStatus(int $id, string $status)
    {
        $registration = RegistrationModel::findOrFail($id);
        $registration->update(['status' => $status]);

        if ($this->selectedRegistrationId === $id) {
            unset($this->selectedRegistration);
        }

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Registration status updated to '.str_replace('_', ' ', $status),
        ]);
    }

    public function closeModal()
    {
        $this->showDetailModal = false;
        $this->selectedRegistrationId = null;
        unset($this->selectedRegistration);
    }

    public function render()
    {
        $registrations = RegistrationModel::with(['user', 'payments'])
            ->select(['id', 'user_id', 'registration_number', 'status', 'participant_type', 'created_at'])
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

    public function downloadExcel()
    {
        return Excel::download(
            new RegistrationsExport($this->search, $this->statusFilter),
            'Registrations CAPEU UNMA 2026.xlsx'
        );
    }
}
