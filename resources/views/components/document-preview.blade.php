@props(['url', 'type' => null, 'hasFile' => true])

@php
    $isPdf = $type === 'application/pdf' || str_ends_with(strtolower($url), '.pdf');
@endphp

<div class="relative group rounded-3xl overflow-hidden bg-primary/20 border border-white/10 aspect-[4/3] flex items-center justify-center">
    @if(!$hasFile)
        <div class="flex flex-col items-center justify-center space-y-4">
            <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center text-white/20">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span class="text-xs font-bold text-white/20 uppercase tracking-widest">No file uploaded</span>
        </div>
    @elseif($isPdf)
        <div class="flex flex-col items-center justify-center space-y-4">
            <div class="w-16 h-16 rounded-2xl bg-red-500/10 flex items-center justify-center text-red-500">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
            </div>
            <span class="text-xs font-bold text-white/40 uppercase tracking-widest">PDF Document</span>
        </div>
    @else
        <img src="{{ $url }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Document Preview">
    @endif

    @if($hasFile)
        {{-- Overlay Actions --}}
        <div class="absolute inset-0 bg-primary/60 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-4">
            <a href="{{ $url }}" target="_blank" class="p-3 rounded-2xl bg-highlight text-primary shadow-xl hover:scale-110 active:scale-95 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </a>
        </div>
    @endif
</div>
