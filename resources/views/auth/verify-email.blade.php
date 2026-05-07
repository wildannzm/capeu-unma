<x-guest-layout>
    <div
        class="bg-primary min-h-screen text-white font-sans py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center relative overflow-hidden">
        <!-- Decorative Background Blobs -->
        <div class="absolute top-0 -left-20 w-96 h-96 bg-secondary/20 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-0 -right-20 w-96 h-96 bg-highlight/10 rounded-full blur-[120px] animate-pulse"
            style="animation-delay: 2s"></div>

        <div class="max-w-md w-full relative z-10">
            <!-- Header -->
            <div class="text-center mb-10">
                <div class="inline-block hover:scale-105 transition-transform duration-300">
                    <h1
                        class="text-3xl md:text-5xl font-heading font-black text-white drop-shadow-md tracking-wider uppercase">
                        Verification
                    </h1>
                    <p class="mt-2 text-highlight font-medium">Verify your account to continue</p>
                </div>
            </div>

            <!-- Form Card -->
            <div
                class="bg-white/5 backdrop-blur-xl border border-white/10 p-8 md:p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
                <div
                    class="absolute -top-24 -right-24 w-64 h-64 bg-highlight/5 rounded-full blur-3xl group-hover:bg-highlight/10 transition-all duration-700">
                </div>

                <div class="relative z-10 space-y-8">
                    <!-- Icon -->
                    <div class="flex justify-center">
                        <div
                            class="w-20 h-20 rounded-3xl bg-highlight/20 text-highlight flex items-center justify-center shadow-lg shadow-highlight/10 shrink-0">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="text-center space-y-4">
                        <p class="text-sm text-white/70 leading-relaxed font-medium">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?') }}
                        </p>
                        <p class="text-xs text-white/40 leading-relaxed font-medium">
                            {{ __('If you didn\'t receive the email, we will gladly send you another.') }}
                        </p>
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div
                            class="p-4 rounded-2xl bg-green-500/10 border border-green-500/20 flex items-center gap-3 animate-bounce">
                            <svg class="w-5 h-5 text-green-400 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-[10px] font-black text-green-400 uppercase tracking-widest leading-tight">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        </div>
                    @endif

                    <div class="space-y-4 pt-4 border-t border-white/10">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit"
                                class="w-full justify-center font-heading font-black text-primary bg-highlight hover:bg-accent px-8 py-4 rounded-2xl transition shadow-[0_0_20px_rgba(202,255,0,0.3)] flex items-center gap-2 text-sm uppercase tracking-widest">
                                {{ __('Resend Verification Email') }}
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
