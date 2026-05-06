<div class="bg-primary min-h-screen text-white font-sans py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
    <div class="max-w-md w-full">
        <!-- Header -->
        <div class="text-center mb-10">
            <a href="{{ route('home') }}" class="inline-block hover:scale-105 transition-transform duration-300">
                <h1
                    class="text-3xl md:text-5xl font-heading font-black text-white drop-shadow-md tracking-wider uppercase">
                    Login
                </h1>
                <p class="mt-2 text-highlight font-medium">Welcome back to CAPEU 2026</p>
            </a>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white/5 backdrop-blur-lg border border-white/10 p-6 md:p-10 rounded-[2rem] shadow-2xl relative overflow-hidden">
            <form wire:submit.prevent="login" class="space-y-6">

                @php
                    $inputClass =
                        'w-full bg-primary border border-white/20 rounded-xl px-4 py-3 text-white focus:border-highlight focus:ring-1 focus:ring-highlight outline-none transition font-sans placeholder-white/30';
                    $checkboxClass =
                        "appearance-none w-5 h-5 bg-white/10 rounded-full border-2 border-white/30 checked:bg-accent checked:border-accent focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-primary cursor-pointer transition relative checked:after:content-[''] checked:after:absolute checked:after:left-[5px] checked:after:top-[2px] checked:after:w-[6px] checked:after:h-[10px] checked:after:border-primary checked:after:border-r-2 checked:after:border-b-2 checked:after:rotate-45";
                @endphp

                <!-- Email -->
                <div>
                    <label class="block font-heading font-bold text-sm mb-2 text-white/80">Email Address</label>
                    <input type="email" wire:model="email" class="{{ $inputClass }}" placeholder="john@example.com"
                        required autofocus>
                    @error('email')
                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div x-data="{ show: false }">
                    <label class="block font-heading font-bold text-sm mb-2 text-white/80">Password</label>
                    <div class="relative group">
                        <input :type="show ? 'text' : 'password'" wire:model="password"
                            class="{{ $inputClass }} pr-12" placeholder="••••••••" required>
                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-white/40 hover:text-highlight transition-colors duration-200 focus:outline-none">
                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mt-4">
                    <label class="flex items-center space-x-3 cursor-pointer group">
                        <input type="checkbox" wire:model="remember" class="{{ $checkboxClass }}">
                        <span class="font-sans text-sm group-hover:text-accent transition">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm font-sans text-white/70 hover:text-highlight transition">
                            Forgot Password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="mt-8 pt-6 border-t border-white/10">
                    <button type="submit"
                        class="w-full justify-center font-heading font-black text-primary bg-highlight hover:bg-accent px-8 py-3 rounded-full transition shadow-[0_0_15px_rgba(202,255,0,0.4)] flex items-center gap-2 text-lg"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="login">Login</span>
                        <span wire:loading wire:target="login">Processing...</span>
                        <svg wire:loading.remove wire:target="login" class="w-5 h-5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </div>

                <!-- Register Link -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-white/70">
                        Don't have an account?
                        <a href="{{ route('register') }}"
                            class="text-highlight font-bold hover:underline transition">Register here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- SweetAlert2 Scripts & Listeners -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('swal:error', (data) => {
                Swal.fire({
                    icon: 'error',
                    title: data[0].title,
                    text: data[0].text,
                    confirmButtonColor: '#CAFF00',
                    background: '#0139CC',
                    color: '#ffffff'
                });
            });

            Livewire.on('swal:success', (data) => {
                Swal.fire({
                    icon: 'success',
                    title: data[0].title,
                    text: data[0].text,
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#0139CC',
                    color: '#ffffff',
                    willClose: () => {
                        window.location.href = data[0].url;
                    }
                });
            });
        });
    </script>
</div>
