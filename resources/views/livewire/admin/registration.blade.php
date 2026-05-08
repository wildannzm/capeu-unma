<div class="space-y-10" x-data="{
    confirmAction(id, status, title, text) {
        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            iconColor: '#CAFF00',
            showCancelButton: true,
            confirmButtonText: 'Confirm Action',
            confirmButtonColor: '#CAFF00',
            cancelButtonText: 'Go Back',
            reverseButtons: true,
            background: '#0139CC',
            color: '#ffffff',
            padding: '4rem',
            customClass: {
                popup: 'rounded-[3.5rem] border border-white/10 shadow-[0_0_50px_rgba(0,0,0,0.5)]',
                confirmButton: '!text-primary font-black !px-8 !py-3 !rounded-xl',
                cancelButton: 'text-white/60 font-bold !px-8 !py-3 !rounded-xl'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $wire.updateStatus(id, status);
            }
        })
    }
}" x-init="Livewire.on('swal:success', (data) => {
    Swal.fire({
        icon: 'success',
        title: data[0].title || 'Success!',
        text: data[0].text || '',
        showConfirmButton: false,
        timer: 2000,
        background: '#0139CC',
        color: '#ffffff',
        customClass: {
            popup: 'rounded-[3rem] border border-white/10 shadow-2xl',
            title: 'font-heading font-black uppercase tracking-tighter',
            htmlContainer: 'font-sans text-white/80'
        }
    });
});

Livewire.on('swal:error', (data) => {
    Swal.fire({
        icon: 'error',
        title: data[0].title || 'Error!',
        text: data[0].text || '',
        confirmButtonColor: '#CAFF00',
        background: '#0139CC',
        color: '#ffffff',
        customClass: {
            popup: 'rounded-[3rem] border border-white/10 shadow-2xl',
            title: 'font-heading font-black uppercase tracking-tighter',
            htmlContainer: 'font-sans text-white/80',
            confirmButton: 'rounded-xl px-8 py-3 font-black uppercase text-[10px] tracking-widest bg-highlight text-primary'
        },
        buttonsStyling: false
    });
});

" x-on:notify.window="
    const payload = Array.isArray($event.detail) ? $event.detail[0] : $event.detail;
    Swal.fire({
        icon: payload.type || 'success',
        title: payload.message || '',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        background: '#0139CC',
        color: '#ffffff',
        customClass: {
            popup: 'rounded-2xl border border-white/10 shadow-xl'
        }
    }).then(() => {
        window.location.reload();
    });
">
    {{-- Header & Stats --}}
    <div
        class="bg-white/5 backdrop-blur-xl rounded-[2.5rem] shadow-2xl border border-white/10 overflow-hidden relative group">
        <div
            class="absolute -right-20 -top-20 w-64 h-64 bg-highlight/5 rounded-full blur-3xl transition-opacity group-hover:opacity-100 opacity-50">
        </div>

        <div class="p-8 md:p-12 relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div>
                <h2 class="font-heading font-black text-3xl md:text-4xl text-white mb-2 tracking-tight">
                    Manage <span class="text-highlight">Registrations</span>
                </h2>
                <p class="text-white/40 font-bold uppercase tracking-widest text-[10px]">
                    Participant Review & Status Management
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-4">
                <div class="relative flex-1 min-w-[300px]">
                    <span class="absolute left-6 top-1/2 -translate-y-1/2 text-white/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Search by name or email..."
                        class="w-full pl-14 pr-6 py-4 bg-white/5 border border-white/10 rounded-2xl text-sm text-white placeholder-white/20 focus:outline-none focus:border-highlight/50 transition-all">
                </div>

                <select wire:model.live="statusFilter"
                    class="px-6 py-4 bg-white/5 border border-white/10 rounded-2xl text-sm text-white focus:outline-none focus:border-highlight/50 transition-all appearance-none cursor-pointer">
                    <option value="" class="bg-primary">All Statuses</option>
                    <option value="submitted" class="bg-primary">Submitted</option>
                    <option value="payment_verified" class="bg-primary">Payment Verified</option>
                    <option value="verified" class="bg-primary">Verified</option>
                    <option value="accepted" class="bg-primary">Accepted</option>
                    <option value="rejected" class="bg-primary">Rejected</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Registrations Table --}}
    <div class="bg-white/5 backdrop-blur-xl rounded-[2.5rem] border border-white/10 overflow-hidden shadow-2xl">
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="p-8 text-[10px] font-black text-white/40 uppercase tracking-widest">#</th>
                        <th class="p-8 text-[10px] font-black text-white/40 uppercase tracking-widest">Participant</th>
                        <th class="p-8 text-[10px] font-black text-white/40 uppercase tracking-widest">Status</th>
                        <th class="p-8 text-[10px] font-black text-white/40 uppercase tracking-widest">Date</th>
                        <th class="p-8 text-[10px] font-black text-white/40 uppercase tracking-widest text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($registrations as $index => $reg)
                        <tr class="group hover:bg-white/[0.02] transition-colors" wire:key="reg-{{ $reg->id }}-{{ $reg->status }}">
                            <td class="p-8">
                                <span class="text-sm font-black text-white/40">
                                    {{ $registrations->firstItem() + $index }}
                                </span>
                            </td>
                            <td class="p-8">
                                <div class="flex items-center">
                                    <div>
                                        <p
                                            class="text-sm font-black text-white group-hover:text-highlight transition-colors">
                                            {{ $reg->user->name }}</p>
                                        <p class="text-[10px] text-white/60 uppercase tracking-widest">
                                            {{ $reg->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-8">
                                @php
                                    $statusColor = match ($reg->status) {
                                        'accepted' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                        'rejected' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                        'verified' => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                                        'payment_verified' => 'bg-highlight/10 text-highlight border-highlight/20',
                                        'submitted' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                        default => 'bg-white/5 text-white/60 border-white/10',
                                    };
                                @endphp
                                <span
                                    class="px-4 py-2 rounded-full text-[8px] font-black uppercase tracking-[0.2em] border {{ $statusColor }}">
                                    {{ $reg->status == 'accepted' ? 'Accepted' : (in_array($reg->status, ['reviewed', 'verified']) ? 'Verified' : str_replace('_', ' ', $reg->status)) }}
                                </span>
                            </td>
                            <td class="p-8">
                                <p class="text-[10px] font-black text-white/60 uppercase tracking-widest">
                                    {{ $reg->created_at->format('M d, Y') }}</p>
                                <p class="text-[9px] text-white/40 uppercase tracking-widest">
                                    {{ $reg->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="p-8 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    @if ($reg->status === 'draft')
                                        <button
                                            @click="confirmAction({{ $reg->id }}, 'under_review', 'Start Review?', 'Move this registration to Under Review status to begin processing?')"
                                            class="px-5 py-3 rounded-xl bg-highlight/10 border border-highlight/20 text-highlight hover:bg-highlight hover:text-primary hover:scale-105 active:scale-95 transition-all outline-none focus:outline-none flex items-center gap-2 group"
                                            title="Start Review">
                                            <span
                                                class="text-[10px] font-black uppercase tracking-widest hidden md:block">Start
                                                Review</span>
                                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    @else
                                        <button wire:click="viewDetails({{ $reg->id }})"
                                            class="p-3 rounded-xl bg-white/5 border border-white/10 text-white/60 hover:text-highlight hover:border-highlight/30 hover:scale-110 active:scale-95 transition-all outline-none focus:outline-none"
                                            title="View Details">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-20 h-20 rounded-[2rem] bg-white/5 flex items-center justify-center text-white/10 mb-6">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-white/20 font-black uppercase tracking-widest text-xs">No
                                        registrations found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile Card View --}}
        <div class="lg:hidden grid grid-cols-1 divide-y divide-white/5">
            @forelse($registrations as $index => $reg)
                <div class="p-8 space-y-6" wire:key="reg-mobile-{{ $reg->id }}-{{ $reg->status }}">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-black text-white/20 uppercase tracking-widest">
                            #{{ $registrations->firstItem() + $index }}
                        </span>
                        @php
                            $statusColor = match ($reg->status) {
                                'accepted' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                'rejected' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                'verified' => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                                'payment_verified' => 'bg-highlight/10 text-highlight border-highlight/20',
                                'submitted' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                default => 'bg-white/5 text-white/60 border-white/10',
                            };
                        @endphp
                        <span
                            class="px-4 py-2 rounded-full text-[8px] font-black uppercase tracking-[0.2em] border {{ $statusColor }}">
                            {{ $reg->status == 'accepted' ? 'Accepted' : (in_array($reg->status, ['reviewed', 'verified']) ? 'Verified' : str_replace('_', ' ', $reg->status)) }}
                        </span>
                    </div>

                    <div>
                        <p class="text-lg font-black text-white">{{ $reg->user->name }}</p>
                        <p class="text-[10px] text-white/40 uppercase tracking-widest">
                            {{ $reg->user->email }}</p>
                    </div>

                    <div class="flex items-center justify-between py-4 border-y border-white/5 text-[10px] font-black uppercase tracking-widest text-white/40">
                        <div>
                            {{ $reg->created_at->format('M d, Y') }}
                        </div>
                        <div>
                            {{ $reg->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        @if ($reg->status === 'draft')
                            <button
                                @click="confirmAction({{ $reg->id }}, 'under_review', 'Start Review?', 'Move this registration to Under Review status to begin processing?')"
                                class="flex-1 px-5 py-3 rounded-xl bg-highlight/10 border border-highlight/20 text-highlight text-[10px] font-black uppercase tracking-widest transition-all">
                                Start Review
                            </button>
                        @else
                            <button wire:click="viewDetails({{ $reg->id }})"
                                class="flex-1 px-5 py-3 rounded-xl bg-white/5 border border-white/10 text-white/60 text-[10px] font-black uppercase tracking-widest transition-all flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View Details
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-20 text-center">
                    <p class="text-white/20 font-black uppercase tracking-widest text-xs">No registrations found</p>
                </div>
            @endforelse
        </div>

        @if ($registrations->hasPages())
            <div class="p-8 border-t border-white/5">
                {{ $registrations->links() }}
            </div>
        @endif
    </div>

    {{-- Detail Modal --}}
    @if ($showDetailModal && $selectedRegistration)
        <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4 md:p-10">
            <div class="absolute inset-0 bg-primary/80 backdrop-blur-md" wire:click="closeModal"></div>

            <div class="relative bg-primary border border-white/10 w-full max-w-5xl max-h-full overflow-y-auto rounded-[3rem] shadow-3xl custom-scrollbar z-10"
                x-data="{ activeTab: 'personal' }">
                {{-- Modal Header --}}
                <div
                    class="sticky top-0 bg-primary/90 backdrop-blur-md border-b border-white/5 p-8 md:p-12 z-20 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-center">
                        <div
                            class="w-16 h-16 rounded-3xl bg-highlight flex items-center justify-center text-primary font-black text-2xl shadow-2xl mr-6">
                            {{ substr($selectedRegistration->user->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-white tracking-tight">
                                {{ $selectedRegistration->user->name }}</h3>
                            <div class="flex items-center gap-3 mt-1">
                                <span
                                    class="text-[10px] font-black text-white/40 uppercase tracking-widest">{{ $selectedRegistration->user->email }}</span>
                                <span class="w-1 h-1 rounded-full bg-white/20"></span>
                                <span
                                    class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-[0.2em] border {{ $statusColor }}">
                                    {{ str_replace('_', ' ', $selectedRegistration->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <button wire:click="closeModal"
                        class="p-4 rounded-2xl bg-white/5 text-white/40 hover:text-white hover:bg-white/10 transition-all outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Modal Content --}}
                <div class="p-8 md:p-12 grid grid-cols-1 lg:grid-cols-3 gap-12">
                    {{-- Navigation Tabs --}}
                    <div class="space-y-3">
                        <button @click="activeTab = 'personal'"
                            :class="activeTab === 'personal' ? 'bg-highlight text-primary' : 'text-white/40 hover:bg-white/5'"
                            class="w-full text-left px-6 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition-all">Personal
                            Info</button>
                        <button @click="activeTab = 'academic'"
                            :class="activeTab === 'academic' ? 'bg-highlight text-primary' : 'text-white/40 hover:bg-white/5'"
                            class="w-full text-left px-6 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition-all">Academic
                            Info</button>
                        <button @click="activeTab = 'documents'"
                            :class="activeTab === 'documents' ? 'bg-highlight text-primary' : 'text-white/40 hover:bg-white/5'"
                            class="w-full text-left px-6 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition-all">Documents</button>
                    </div>

                    {{-- Tab Panels --}}
                    <div class="lg:col-span-2">
                        <div x-show="activeTab === 'personal'" class="space-y-8" x-transition>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-white/40 uppercase tracking-widest">Full Name
                                    </p>
                                    <p class="text-sm font-bold text-white">
                                        {{ $selectedRegistration->personal_info['full_name'] ?? 'N/A' }}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-white/40 uppercase tracking-widest">Gender
                                    </p>
                                    <p class="text-sm font-bold text-white uppercase">
                                        {{ $selectedRegistration->personal_info['gender'] ?? 'N/A' }}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-white/40 uppercase tracking-widest">Phone
                                        Number</p>
                                    <p class="text-sm font-bold text-white">
                                        {{ $selectedRegistration->personal_info['whatsapp'] ?? 'N/A' }}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-white/40 uppercase tracking-widest">
                                        Nationality</p>
                                    <p class="text-sm font-bold text-white">
                                        {{ $selectedRegistration->personal_info['nationality'] ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <div x-show="activeTab === 'academic'" class="space-y-8" x-transition>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-white/40 uppercase tracking-widest">
                                        University</p>
                                    <p class="text-sm font-bold text-white">
                                        {{ $selectedRegistration->academic_info['university_name'] ?? 'N/A' }}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-white/40 uppercase tracking-widest">Major</p>
                                    <p class="text-sm font-bold text-white">
                                        {{ $selectedRegistration->academic_info['major'] ?? 'N/A' }}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-white/40 uppercase tracking-widest">Year of
                                        Study</p>
                                    <p class="text-sm font-bold text-white">
                                        {{ $selectedRegistration->academic_info['year_semester'] ?? 'N/A' }}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-white/40 uppercase tracking-widest">GPA</p>
                                    <p class="text-sm font-bold text-white">
                                        {{ $selectedRegistration->academic_info['gpa'] ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <div x-show="activeTab === 'documents'" class="space-y-8" x-transition>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                @foreach (['passport', 'student_card', 'formal_photo', 'cv', 'motivation_letter'] as $doc)
                                    @php
                                        $path = $selectedRegistration->{$doc . '_path'} ?? '';
                                        $isPdf = str_ends_with(strtolower($path), '.pdf');
                                    @endphp
                                    <div class="space-y-3">
                                        <p class="text-[10px] font-black text-white/40 uppercase tracking-widest">
                                            {{ str_replace('_', ' ', $doc) }}</p>
                                        <x-document-preview :url="route('documents.show', [
                                            'registration' => $selectedRegistration->id,
                                            'field' => $doc,
                                        ])" :type="$isPdf ? 'application/pdf' : 'image/jpeg'" :hasFile="!empty($path)" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Footer Actions --}}
                <div class="p-8 md:p-12 border-t border-white/5 bg-white/[0.02] flex items-center justify-end gap-4">
                    @if ($selectedRegistration->status === 'payment_verified')
                        <button
                            @click="confirmAction({{ $selectedRegistration->id }}, 'verified', 'Verify Documents?', 'Confirm that all uploaded documents are valid and correct?')"
                            class="px-8 py-4 rounded-2xl bg-highlight text-primary font-black text-xs uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-xl shadow-highlight/20">
                            Verify Documents
                        </button>
                        <button
                            @click="confirmAction({{ $selectedRegistration->id }}, 'rejected', 'Reject Participant?', 'This will notify the participant that their application was unsuccessful.')"
                            class="px-8 py-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-500 font-black text-xs uppercase tracking-widest hover:bg-red-500 hover:text-white hover:scale-105 active:scale-95 transition-all">
                            Reject Participant
                        </button>
                    @elseif ($selectedRegistration->status === 'verified')
                        <button
                            @click="confirmAction({{ $selectedRegistration->id }}, 'accepted', 'Accept Registration?', 'Finalize this participant as accepted?')"
                            class="px-8 py-4 rounded-2xl bg-green-500 text-white font-black text-xs uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-xl shadow-green-500/20">
                            Accept Registration
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
