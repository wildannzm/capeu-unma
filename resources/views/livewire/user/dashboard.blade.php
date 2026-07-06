<div x-data="{ previewModal: false, previewUrl: '', previewTitle: '', previewType: '' }" class="space-y-10">
    @if ($this->registration)
        <div class="flex flex-col lg:grid lg:grid-cols-3 gap-10">
            <div class="order-1 lg:col-span-2 space-y-10">
                {{-- Status Banner --}}
                <div
                    class="bg-white/5 backdrop-blur-xl rounded-[2.5rem] shadow-2xl border border-white/10 overflow-hidden relative group">
                    <div
                        class="absolute -right-20 -top-20 w-64 h-64 bg-highlight/5 rounded-full blur-3xl transition-opacity group-hover:opacity-100 opacity-50">
                    </div>

                    <div class="p-8 md:p-12 relative z-10">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                            <div>
                                <h2 class="font-heading font-black text-3xl md:text-4xl text-white mb-2 tracking-tight">
                                    Hallo, <span
                                        class="text-highlight">{{ explode(' ', auth()->user()->name)[0] }}!</span>
                                </h2>
                                <p class="text-white/40 font-bold uppercase tracking-widest text-[10px]">
                                    Registration No: <span
                                        class="text-white select-all">{{ $this->registration->registration_number }}</span>
                                </p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="bg-white/5 border border-white/10 px-6 py-3 rounded-2xl">
                                    <p class="text-[10px] font-black text-white/40 uppercase tracking-widest mb-1">
                                        Participant Type</p>
                                    <p class="text-sm font-black text-highlight uppercase">
                                        {{ str_replace('_', ' ', $this->registration->participant_type) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Progress Timeline --}}
                    <div class="bg-white/[0.02] border-t border-white/10 p-8 md:p-12 relative z-10">
                        <div class="flex items-center justify-between mb-12">
                            <h3 class="font-heading font-black text-xs uppercase tracking-[0.3em] text-white/30">Journey
                                Progress</h3>
                            <span
                                class="text-[10px] font-black text-highlight uppercase tracking-widest bg-highlight/10 px-3 py-1 rounded-full border border-highlight/20 whitespace-nowrap">
                                {{ round($this->registration->status == 'accepted'? 100: match ($this->registration->status) {'submitted', 'draft' => 33,'payment_verified', 'reviewed', 'verified' => 66,default => 33}) }}%
                                Complete
                            </span>
                        </div>

                        <div class="relative px-4">
                            @php
                                $statuses = [
                                    ['key' => 'submitted', 'label' => 'Submitted', 'step' => 1],
                                    ['key' => 'verified', 'label' => 'Payment & Document Verified', 'step' => 2],
                                    ['key' => 'accepted', 'label' => 'Accepted', 'step' => 3],
                                ];

                                $currentStep = match ($this->registration->status) {
                                    'submitted', 'draft' => 1,
                                    'payment_verified', 'reviewed', 'verified' => 2,
                                    'accepted', 'rejected' => 3,
                                    default => 1,
                                };
                            @endphp

                            {{-- Desktop Timeline --}}
                            <div class="hidden md:block">
                                <div
                                    class="absolute top-5 left-10 right-10 h-1 bg-white/10 rounded-full overflow-hidden">
                                    <div class="h-full bg-accent transition-all duration-1000 shadow-[0_0_20px_rgba(202,255,0,0.6)]"
                                        style="width: {{ (($currentStep - 1) / 2) * 100 }}%"></div>
                                </div>

                                <div class="relative flex justify-between">
                                    @foreach ($statuses as $step)
                                        <div class="flex flex-col items-center group">
                                            <div
                                                class="relative z-10 flex items-center justify-center w-11 h-11 rounded-2xl {{ $currentStep >= $step['step'] ? 'bg-accent text-primary shadow-[0_0_25px_rgba(202,255,0,0.5)] rotate-0' : 'bg-primary border border-white/10 text-white/30 rotate-12 group-hover:rotate-0 transition-all duration-500' }}">
                                                @if ($currentStep > $step['step'] || ($this->registration->status == 'accepted' && $step['step'] == 3))
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                @elseif($this->registration->status == 'rejected' && $step['step'] == 3)
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                @else
                                                    <span class="font-black text-sm">{{ $step['step'] }}</span>
                                                @endif
                                            </div>
                                            <div class="mt-4 text-center">
                                                <p
                                                    class="text-[9px] font-black uppercase tracking-[0.2em] {{ $currentStep >= $step['step'] ? 'text-white' : 'text-white/20' }}">
                                                    {{ $step['key'] === 'accepted' && $this->registration->status === 'rejected' ? 'Rejected' : $step['label'] }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Mobile Timeline --}}
                            <div class="md:hidden space-y-8">
                                @foreach ($statuses as $step)
                                    <div class="flex items-center space-x-6">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center {{ $currentStep >= $step['step'] ? 'bg-accent text-primary shadow-[0_0_15px_rgba(202,255,0,0.3)]' : 'bg-white/5 border border-white/10 text-white/20' }}">
                                            @if ($currentStep > $step['step'] || ($this->registration->status == 'accepted' && $step['step'] == 3))
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7" />
                                                </svg>
                                            @elseif($this->registration->status == 'rejected' && $step['step'] == 3)
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            @else
                                                <span class="text-xs font-black">{{ $step['step'] }}</span>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <p
                                                class="text-xs font-black uppercase tracking-widest {{ $currentStep >= $step['step'] ? 'text-white' : 'text-white/20' }}">
                                                {{ $step['key'] === 'accepted' && $this->registration->status === 'rejected' ? 'Rejected' : $step['label'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
            </div>

            {{-- Sidebar Info --}}
            <div class="order-3 lg:order-2 space-y-8">
                <div
                    class="bg-gradient-to-br from-highlight to-accent p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
                    <div
                        class="absolute -right-10 -top-10 w-40 h-40 bg-white/20 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-700">
                    </div>
                    <div class="relative z-10 flex flex-col justify-center">
                        <h4
                            class="font-heading font-black text-2xl text-primary mb-3 uppercase leading-none tracking-tighter">
                            Support Center</h4>
                        <p class="text-primary/70 text-[11px] font-bold mb-8 uppercase tracking-wider leading-relaxed">
                            Having trouble with documents or payment? Reach out to our team.</p>
                        <a href="https://wa.me/6285624425461" target="_blank" rel="noopener noreferrer"
                            class="flex items-center justify-center w-full py-4 bg-primary text-white font-black rounded-2xl text-[10px] uppercase tracking-widest transition-all hover:shadow-xl active:scale-95 outline-none focus:outline-none focus:ring-0">
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
        {{-- Action Cards --}}
        @php
            $transportType = $this->registration->transportation['type'] ?? null;
            $showArrival = in_array($transportType, ['Plane', 'Train']);
        @endphp
        <div class="order-2 lg:order-3 lg:col-span-3 w-full">
            <div class="grid grid-cols-1 md:grid-cols-2 {{ $showArrival ? 'lg:grid-cols-3' : '' }} gap-8 items-start">
                    <div class="bg-white/5 backdrop-blur-xl p-8 rounded-[2rem] border border-white/10 shadow-2xl group overflow-hidden relative flex flex-col h-full">
                        <div class="flex items-center justify-between mb-8">
                            <h4 class="font-heading font-black text-lg uppercase tracking-widest text-white">Payment
                                Status</h4>
                            <div
                                class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10 group-hover:border-highlight/30 transition-colors">
                                <svg class="w-6 h-6 text-highlight" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                        </div>
                        <div class="space-y-4">
                            @forelse($this->registration->payments as $payment)
                                <div
                                    class="flex items-center justify-between p-5 bg-white/5 rounded-3xl border border-white/10 hover:bg-white/[0.08] transition-[background-color,transform] duration-300 overflow-hidden">
                                    <div>
                                        <p class="text-lg font-black text-white">USD
                                            {{ number_format($payment->amount, 2) }}</p>
                                        <p class="text-[10px] text-white/30 uppercase tracking-[0.2em] mt-1">
                                            {{ $payment->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <span
                                        class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ $payment->verified_at ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30' }}">
                                        {{ $payment->verified_at ? 'Verified' : 'Pending' }}
                                    </span>
                                </div>
                            @empty
                                <div class="text-center py-10">
                                    <p class="text-xs text-white/20 italic font-medium mb-6 uppercase tracking-widest">
                                        No payment records found.</p>
                                    <button
                                        class="w-full py-4 bg-highlight text-primary font-black rounded-2xl text-xs uppercase tracking-widest hover:shadow-[0_0_20px_rgba(202,255,0,0.3)] transition-all active:scale-95 outline-none focus:outline-none focus:ring-0">
                                        Upload Payment Proof
                                    </button>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div
                        class="bg-white/5 backdrop-blur-xl p-8 rounded-[2rem] border border-white/10 shadow-2xl group overflow-hidden relative flex flex-col h-full">
                        <div class="flex items-center justify-between mb-8">
                            <h4 class="font-heading font-black text-lg uppercase tracking-widest text-white">My
                                Documents</h4>
                            <div
                                class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10 group-hover:border-highlight/30 transition-colors">
                                <svg class="w-6 h-6 text-highlight" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="space-y-4">
                            @php
                                $docs = [
                                    [
                                        'key' => 'passport',
                                        'label' => 'Passport',
                                        'path' => $this->registration->passport_path,
                                        'icon' =>
                                            'M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129',
                                    ],
                                    [
                                        'key' => 'student_card',
                                        'label' => 'Student Card',
                                        'path' => $this->registration->student_card_path,
                                        'icon' =>
                                            'M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14',
                                    ],
                                    [
                                        'key' => 'formal_photo',
                                        'label' => 'Formal Photo',
                                        'path' => $this->registration->formal_photo_path,
                                        'icon' =>
                                            'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                                    ],
                                ];
                            @endphp

                            @foreach ($docs as $doc)
                                @if ($doc['path'])
                                    @php
                                        $viewRoute = route('documents.show', [
                                            'registration' => $this->registration->id,
                                            'field' => $doc['key'],
                                        ]);
                                    @endphp
                                    <div
                                        class="flex items-center justify-between p-4 border border-white/5 bg-white/[0.03] rounded-2xl hover:bg-white/[0.06] transition-[background-color,border-color] duration-300 group/item overflow-hidden">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center mr-4 border border-white/10 group-hover/item:border-highlight/30 transition-colors duration-300">
                                                <svg class="w-4 h-4 text-white/40 group-hover/item:text-highlight transition-colors duration-300" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="{{ $doc['icon'] }}" />
                                                </svg>
                                            </div>
                                            <span
                                                class="text-xs font-black uppercase tracking-widest text-white/70 group-hover/item:text-white transition-colors duration-300">{{ $doc['label'] }}</span>
                                        </div>
                                        <div class="flex items-center space-x-1">
                                            <button
                                                @click="previewModal = true; previewUrl = '{{ $viewRoute }}'; previewTitle = '{{ $doc['label'] }}'; previewType = '{{ str_ends_with($doc['path'], '.pdf') ? 'pdf' : 'image' }}'"
                                                class="p-3 text-white/20 hover:text-highlight transition-colors duration-300 outline-none focus:outline-none" title="Preview Document">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>

                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    @if($showArrival)
                    <div class="bg-white/5 backdrop-blur-xl p-8 rounded-[2rem] border border-white/10 shadow-2xl group overflow-hidden relative flex flex-col h-full">
                        <div class="flex items-center justify-between mb-8">
                            <h4 class="font-heading font-black text-lg uppercase tracking-widest text-white">Arrival Information</h4>
                            <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10 group-hover:border-highlight/30 transition-colors">
                                <svg class="w-6 h-6 text-highlight" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="p-6 bg-highlight/5 border border-highlight/20 rounded-3xl flex items-start gap-4">
                            <div class="mt-1">
                                <svg class="w-6 h-6 text-highlight" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-white/90 leading-relaxed font-sans">
                                @if($transportType === 'Plane')
                                    The committee will wait at <span class="font-bold text-highlight">Soekarno-Hatta Airport (CGK)</span> on <span class="font-bold text-white">August 23, 2026, at 2 PM</span> Western Indonesia Time.
                                @elseif($transportType === 'Train')
                                    The committee will wait at <span class="font-bold text-highlight">Cirebon Train Station (CN)</span> at <span class="font-bold text-white">August 23, 2026, at 4 PM</span> Western Indonesia Time.
                                @endif
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div
            class="bg-white/5 backdrop-blur-2xl rounded-[3rem] p-12 md:p-20 text-center shadow-2xl border border-white/10 max-w-3xl mx-auto relative overflow-hidden group">
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-highlight/5 rounded-full blur-3xl opacity-50"></div>

            <div
                class="w-28 h-28 bg-white/5 rounded-[2rem] border border-white/10 flex items-center justify-center mx-auto mb-10 rotate-12 group-hover:rotate-0 transition-all duration-700 shadow-xl group-hover:border-highlight/40 group-hover:bg-highlight/10">
                <svg class="w-12 h-12 text-white/20 group-hover:text-highlight transition-colors" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>

            <h3
                class="font-heading font-black text-4xl md:text-5xl text-white mb-6 uppercase tracking-tighter leading-none">
                Begin Your <span class="text-highlight">Journey</span>
            </h3>
            <p class="text-white/50 mb-12 leading-relaxed text-lg font-medium max-w-md mx-auto">
                Secure your spot in the <span class="text-white">CAPEU 2026</span> international mobility program and
                experience Majalengka like never before.
            </p>

            <a href="{{ route('register') }}"
                class="inline-flex items-center px-12 py-5 bg-highlight text-primary font-black rounded-2xl transition-all hover:shadow-[0_0_40px_rgba(202,255,0,0.4)] active:scale-95 text-sm uppercase tracking-widest group/btn">
                Apply Now!
                <svg class="w-5 h-5 ml-3 group-hover:translate-x-2 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    @endif

    {{-- Document Preview Modal --}}
    <div x-show="previewModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>

        <div class="fixed inset-0 bg-primary/80 backdrop-blur-md" @click="previewModal = false"></div>

        <div class="bg-white/5 backdrop-blur-2xl border border-white/10 w-full max-w-5xl h-[85vh] rounded-[2.5rem] shadow-2xl relative overflow-hidden flex flex-col z-10"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="scale-95 translate-y-4" x-transition:enter-end="scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="scale-100 translate-y-0" x-transition:leave-end="scale-95 translate-y-4">

            <!-- Modal Header -->
            <div class="p-6 md:p-8 border-b border-white/10 flex items-center justify-between bg-white/[0.02]">
                <div>
                    <h3 class="font-heading font-black text-xl text-white uppercase tracking-widest"
                        x-text="previewTitle"></h3>
                    <p class="text-[10px] font-bold text-white/30 uppercase tracking-[0.2em] mt-1">Document Preview</p>
                </div>
                <button @click="previewModal = false"
                    class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-white/40 hover:text-red-400 hover:bg-red-400/10 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="flex-1 overflow-auto p-4 md:p-8 bg-black/20">
                <template x-if="previewType === 'image'">
                    <div class="w-full h-full flex items-center justify-center">
                        <img :src="previewUrl"
                            class="max-w-full max-h-full rounded-2xl shadow-2xl border border-white/5 object-contain" />
                    </div>
                </template>

                <template x-if="previewType === 'pdf'">
                    <iframe :src="previewUrl"
                        class="w-full h-full rounded-2xl bg-white/5 border border-white/5"></iframe>
                </template>
            </div>

            <!-- Modal Footer -->
            <div class="p-6 border-t border-white/10 bg-white/[0.02] flex justify-end">
                <a :href="previewUrl" target="_blank"
                    class="px-8 py-3 bg-highlight text-primary font-black rounded-xl text-xs uppercase tracking-widest hover:shadow-[0_0_20px_rgba(202,255,0,0.3)] transition-all active:scale-95">
                    Open in New Tab
                </a>
            </div>
        </div>
    </div>
</div>
