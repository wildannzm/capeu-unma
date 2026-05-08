<div class="space-y-10">
    {{-- Admin Welcome Banner --}}
    <div
        class="bg-white/5 backdrop-blur-xl rounded-[2.5rem] shadow-2xl border border-white/10 overflow-hidden relative group">
        <div
            class="absolute -right-20 -top-20 w-64 h-64 bg-highlight/5 rounded-full blur-3xl transition-opacity group-hover:opacity-100 opacity-50">
        </div>

        <div class="p-8 md:p-12 relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="font-heading font-black text-3xl md:text-4xl text-white mb-2 tracking-tight">
                    Admin <span class="text-highlight">Overview</span>
                </h2>
            </div>
            <div class="flex items-center gap-4">
                <div class="px-6 py-3 rounded-2xl bg-white/5 border border-white/10 flex flex-col items-end">
                    <span class="text-[10px] font-black text-white/20 uppercase tracking-widest">Total Verified</span>
                    <span class="text-xl font-black text-highlight">${{ number_format($totalVerifiedAmount, 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @php
            $statsItems = [
                [
                    'label' => 'Total Registrations',
                    'value' => $totalRegistrations,
                    'icon' =>
                        'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'color' => 'text-highlight',
                    'bg' => 'bg-highlight/10',
                    'route' => 'admin.registrations',
                ],
                [
                    'label' => 'Pending Payment & Review Document',
                    'value' => $pendingPayments,
                    'icon' =>
                        'M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z',
                    'color' => 'text-yellow-400',
                    'bg' => 'bg-yellow-400/10',
                    'route' => 'admin.payments',
                ],
                [
                    'label' => 'Total Participants',
                    'value' => $totalUsers,
                    'icon' =>
                        'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                    'color' => 'text-blue-400',
                    'bg' => 'bg-blue-400/10',
                    'route' => 'admin.registrations',
                ],
            ];
        @endphp

        @foreach ($statsItems as $item)
            <a href="{{ route($item['route']) }}"
                class="bg-white/5 backdrop-blur-xl p-8 rounded-[2rem] border border-white/10 hover:border-highlight/30 transition-all duration-500 group flex flex-col justify-between h-full relative overflow-hidden">
                <div
                    class="absolute -right-8 -bottom-8 w-24 h-24 {{ $item['bg'] }} rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700">
                </div>

                <div class="relative z-10">
                    <div
                        class="w-14 h-14 rounded-2xl {{ $item['bg'] }} flex items-center justify-center {{ $item['color'] }} mb-6 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="{{ $item['icon'] }}" />
                        </svg>
                    </div>
                    <p class="text-white/40 font-bold uppercase tracking-widest text-[10px] mb-1">{{ $item['label'] }}
                    </p>
                    <h3 class="text-4xl font-black text-white group-hover:text-highlight transition-colors">
                        {{ $item['value'] }}</h3>
                </div>
            </a>
        @endforeach
    </div>
</div>
