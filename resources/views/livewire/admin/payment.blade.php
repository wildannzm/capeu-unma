    <style>
        .swal-backdrop-blur {
            backdrop-filter: blur(8px);
        }

        .swal-glass {
            background: rgba(1, 57, 204, 0.8) !important;
            backdrop-filter: blur(12px);
        }
    </style>

    <div class="space-y-10" x-data="{
        confirmAction(id, status, title, text) {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'warning',
                    iconColor: '#CAFF00',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    confirmButtonColor: '#CAFF00',
                    cancelButtonText: 'Go Back',
                    reverseButtons: true,
                    background: '#0139CC',
                    color: '#ffffff',
                    padding: '4rem',
                    customClass: {
                        container: 'swal-backdrop-blur',
                        popup: 'rounded-[3.5rem] border border-white/10 shadow-[0_0_50px_rgba(0,0,0,0.5)] swal-glass',
                        confirmButton: '!text-primary font-black !px-8 !py-3 !rounded-xl',
                        cancelButton: 'text-white/60 font-bold !px-8 !py-3 !rounded-xl'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.updateStatus(id, status);
                    }
                })
            },
            viewProof(url, isPdf) {
                if (isPdf) {
                    Swal.fire({
                        title: 'Payment Proof',
                        html: `<iframe src='${url}' class='w-full h-[30vh] rounded-2xl border-0'></iframe>`,
                        showCloseButton: true,
                        showConfirmButton: false,
                        width: '35%',
                        color: '#ffffff',
                        customClass: {
                            container: 'swal-backdrop-blur',
                            popup: 'rounded-[3rem] border border-white/10 shadow-2xl p-8 swal-glass',
                        }
                    });
                } else {
                    Swal.fire({
                        imageUrl: url,
                        imageAlt: 'Payment Proof',
                        showCloseButton: true,
                        showConfirmButton: false,
                        width: '25%',
                        color: '#ffffff',
                        customClass: {
                            container: 'swal-backdrop-blur',
                            popup: 'rounded-[3rem] border border-white/10 shadow-2xl p-8 swal-glass',
                            image: 'rounded-2xl shadow-xl'
                        }
                    });
                }
            }
    }"
        x-on:notify.window="
    const payload = $event.detail[0];
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
        {{-- Header --}}
        <div
            class="bg-white/5 backdrop-blur-xl rounded-[2.5rem] shadow-2xl border border-white/10 overflow-hidden relative group">
            <div
                class="absolute -right-20 -top-20 w-64 h-64 bg-highlight/5 rounded-full blur-3xl transition-opacity group-hover:opacity-100 opacity-50">
            </div>

            <div class="p-8 md:p-12 relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div>
                    <h2 class="font-heading font-black text-3xl md:text-4xl text-white mb-2 tracking-tight">
                        Payment <span class="text-highlight">Verification</span>
                    </h2>
                    <p class="text-white/40 font-bold uppercase tracking-widest text-[10px]">
                        Manage and Verify Participant Payments
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
                            placeholder="Search by participant name..."
                            class="w-full pl-14 pr-6 py-4 bg-white/5 border border-white/10 rounded-2xl text-sm text-white placeholder-white/20 focus:outline-none focus:border-highlight/50 transition-all">
                    </div>

                    <select wire:model.live="statusFilter"
                        class="px-6 py-4 bg-white/5 border border-white/10 rounded-2xl text-sm text-white focus:outline-none focus:border-highlight/50 transition-all appearance-none cursor-pointer">
                        <option value="" class="bg-primary">All Statuses</option>
                        <option value="pending" class="bg-primary">Pending</option>
                        <option value="verified" class="bg-primary">Verified</option>
                        <option value="rejected" class="bg-primary">Rejected</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Payments Table --}}
        <div class="bg-white/5 backdrop-blur-xl rounded-[2.5rem] border border-white/10 overflow-hidden shadow-2xl">
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/5">
                            <th class="p-8 text-[10px] font-black text-white/40 uppercase tracking-widest">#</th>
                            <th class="p-8 text-[10px] font-black text-white/40 uppercase tracking-widest">Participant
                            </th>
                            <th class="p-8 text-[10px] font-black text-white/40 uppercase tracking-widest">Amount</th>
                            <th class="p-8 text-[10px] font-black text-white/40 uppercase tracking-widest">Method</th>
                            <th class="p-8 text-[10px] font-black text-white/40 uppercase tracking-widest">Status</th>
                            <th class="p-8 text-[10px] font-black text-white/40 uppercase tracking-widest">Proof</th>
                            <th class="p-8 text-[10px] font-black text-white/40 uppercase tracking-widest text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($payments as $index => $payment)
                            <tr class="group hover:bg-white/[0.02] transition-colors"
                                wire:key="payment-{{ $payment->id }}-{{ $payment->status }}">
                                <td class="p-8">
                                    <span class="text-sm font-black text-white/40">
                                        {{ $payments->firstItem() + $index }}
                                    </span>
                                </td>
                                <td class="p-8">
                                    <div class="flex items-center">
                                        <div>
                                            <p
                                                class="text-sm font-black text-white group-hover:text-highlight transition-colors">
                                                {{ $payment->registration->user->name }}</p>
                                            <p class="text-[9px] text-white/40 uppercase tracking-widest">
                                                {{ $payment->registration->registration_number }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-8">
                                    <p class="text-sm font-black text-white">{{ $payment->currency }}
                                        {{ number_format($payment->amount, 2) }}</p>
                                    <p class="text-[9px] text-white/40 uppercase tracking-widest">
                                        {{ $payment->created_at->format('M d, H:i') }}</p>
                                </td>
                                <td class="p-8">
                                    <span
                                        class="text-[10px] font-bold text-white/60 uppercase tracking-widest">{{ $payment->payment_method }}</span>
                                </td>
                                <td class="p-8">
                                    @php
                                        $statusColor = match ($payment->status) {
                                            'verified' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                            'rejected' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                            'pending' => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                                            default => 'bg-white/5 text-white/60 border-white/10',
                                        };
                                    @endphp
                                    <span
                                        class="px-3 py-1.5 rounded-full text-[8px] font-black uppercase tracking-[0.2em] border {{ $statusColor }}">
                                        {{ $payment->status }}
                                    </span>
                                </td>
                                <td class="p-8">
                                    @if ($payment->payment_proof_path)
                                        @php
                                            $proofUrl = route('documents.show', [
                                                'registration' => $payment->registration_id,
                                                'field' => 'proof',
                                            ]);
                                            $isPdf = str_ends_with(strtolower($payment->payment_proof_path), '.pdf');
                                        @endphp
                                        <button
                                            @click="viewProof('{{ $proofUrl }}', {{ $isPdf ? 'true' : 'false' }})"
                                            class="p-2 rounded-lg bg-white/5 border border-white/10 text-highlight hover:bg-highlight hover:text-primary transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    @else
                                        <span class="text-[9px] text-white/20 uppercase font-black">No Proof</span>
                                    @endif
                                </td>
                                <td class="p-8 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if ($payment->status === 'pending')
                                            <button
                                                @click="confirmAction({{ $payment->id }}, 'verified', 'Approve Payment?', 'Mark this payment as verified?')"
                                                class="p-2 rounded-lg bg-green-500/10 border border-green-500/20 text-green-400 hover:bg-green-500 hover:text-white transition-all"
                                                title="Approve">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                            <button
                                                @click="confirmAction({{ $payment->id }}, 'rejected', 'Reject Payment?', 'Mark this payment as rejected?')"
                                                class="p-2 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500 hover:text-white transition-all"
                                                title="Reject">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-20 h-20 rounded-[2rem] bg-white/5 flex items-center justify-center text-white/10 mb-6">
                                            <svg class="w-10 h-10" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-white/20 font-black uppercase tracking-widest text-xs">No
                                            payments found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Mobile Card View --}}
            <div class="lg:hidden grid grid-cols-1 divide-y divide-white/5">
                @forelse($payments as $index => $payment)
                    <div class="p-8 space-y-6" wire:key="payment-mobile-{{ $payment->id }}-{{ $payment->status }}">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-black text-white/20 uppercase tracking-widest">
                                #{{ $payments->firstItem() + $index }}
                            </span>
                            @php
                                $statusColor = match ($payment->status) {
                                    'verified' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                    'rejected' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                    'pending' => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                                    default => 'bg-white/5 text-white/60 border-white/10',
                                };
                            @endphp
                            <span
                                class="px-3 py-1.5 rounded-full text-[8px] font-black uppercase tracking-[0.2em] border {{ $statusColor }}">
                                {{ $payment->status }}
                            </span>
                        </div>

                        <div>
                            <p class="text-lg font-black text-white">{{ $payment->registration->user->name }}</p>
                            <p class="text-[10px] text-white/40 uppercase tracking-widest">
                                {{ $payment->registration->registration_number }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4 py-4 border-y border-white/5">
                            <div>
                                <p class="text-[9px] text-white/40 uppercase tracking-widest mb-1">Amount</p>
                                <p class="text-sm font-black text-white">{{ $payment->currency }}
                                    {{ number_format($payment->amount, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] text-white/40 uppercase tracking-widest mb-1">Method</p>
                                <p class="text-sm font-black text-white/60">{{ $payment->payment_method }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <div class="flex items-center gap-3">
                                @if ($payment->payment_proof_path)
                                    @php
                                        $proofUrl = route('documents.show', [
                                            'registration' => $payment->registration_id,
                                            'field' => 'proof',
                                        ]);
                                        $isPdf = str_ends_with(strtolower($payment->payment_proof_path), '.pdf');
                                    @endphp
                                    <button
                                        @click="viewProof('{{ $proofUrl }}', {{ $isPdf ? 'true' : 'false' }})"
                                        class="px-4 py-2 rounded-xl bg-highlight/10 border border-highlight/20 text-highlight text-[10px] font-black uppercase tracking-widest transition-all">
                                        View Proof
                                    </button>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                @if ($payment->status === 'pending')
                                    <button
                                        @click="confirmAction({{ $payment->id }}, 'verified', 'Approve Payment?', 'Mark this payment as verified?')"
                                        class="p-3 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>
                                    <button
                                        @click="confirmAction({{ $payment->id }}, 'rejected', 'Reject Payment?', 'Mark this payment as rejected?')"
                                        class="p-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-20 text-center">
                        <p class="text-white/20 font-black uppercase tracking-widest text-xs">No payments found</p>
                    </div>
                @endforelse
            </div>

            @if ($payments->hasPages())
                <div class="p-8 border-t border-white/5">
                    {{ $payments->links() }}
                </div>
            @endif
        </div>
    </div>
