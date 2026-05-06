<x-guest-layout>
    <div
        class="bg-primary min-h-screen text-white font-sans py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
        <div class="max-w-md w-full">
            <!-- Header -->
            <div class="text-center mb-10">
                <a href="{{ route('home') }}" class="inline-block hover:scale-105 transition-transform duration-300">
                    <h1
                        class="text-3xl md:text-4xl font-heading font-black text-white drop-shadow-md tracking-wider uppercase">
                        Forgot Password
                    </h1>
                    <p class="mt-2 text-highlight font-medium">Reset your CAPEU 2026 account</p>
                </a>
            </div>

            <!-- Form Card -->
            <div
                class="bg-white/5 backdrop-blur-lg border border-white/10 p-6 md:p-10 rounded-[2rem] shadow-2xl relative overflow-hidden">
                <div class="mb-6 text-sm text-white/80 font-sans leading-relaxed">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                @session('status')
                    <div class="mb-6 font-bold text-sm text-highlight">
                        {{ $value }}
                    </div>
                @endsession

                <x-validation-errors class="mb-6 [&>div>ul>li]:text-red-400 [&>div>div]:text-red-400" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    @php
                        $inputClass =
                            'w-full bg-primary border border-white/20 rounded-xl px-4 py-3 text-white focus:border-highlight focus:ring-1 focus:ring-highlight outline-none transition font-sans placeholder-white/30';
                    @endphp

                    <!-- Email -->
                    <div>
                        <label
                            class="block font-heading font-bold text-sm mb-2 text-white/80">{{ __('Email Address') }}</label>
                        <input id="email" type="email" name="email" :value="old('email')"
                            class="{{ $inputClass }}" placeholder="john@example.com" required autofocus
                            autocomplete="username">
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 pt-6 border-t border-white/10">
                        <button type="submit"
                            class="w-full justify-center font-heading font-black text-primary bg-highlight hover:bg-accent px-8 py-3 rounded-full transition shadow-[0_0_15px_rgba(202,255,0,0.4)] flex items-center gap-2 text-lg">
                            <span>{{ __('Email Password Reset Link') }}</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Back to Login Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-white/70">
                            Remember your password?
                            <a href="{{ route('login') }}"
                                class="text-highlight font-bold hover:underline transition">Back to Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('status'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const event = new CustomEvent('swal:alert', {
                    detail: [{
                        type: 'success',
                        title: 'Success!',
                        text: '{{ session('status') }}'
                    }]
                });
                window.dispatchEvent(event);
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const event = new CustomEvent('swal:alert', {
                    detail: [{
                        type: 'error',
                        title: 'Error!',
                        text: '{{ $errors->first() }}'
                    }]
                });
                window.dispatchEvent(event);
            });
        </script>
    @endif
</x-guest-layout>
