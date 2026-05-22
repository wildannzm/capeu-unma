<div class="max-w-7xl mx-auto space-y-10">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-3xl font-black text-white uppercase tracking-tight">Profile Settings</h2>
            <p class="text-white/40 font-medium tracking-wide mt-1 uppercase text-xs">Manage your account information and
                security</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Sidebar: Stats & Status -->
        <div class="lg:col-span-4 space-y-8">
            <div
                class="bg-primary/40 backdrop-blur-xl border border-white/10 rounded-3xl p-8 relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-highlight/5 rounded-full blur-3xl group-hover:bg-highlight/10 transition-colors duration-500">
                </div>

                <div class="relative flex flex-col items-center text-center space-y-6">
                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-3xl bg-gradient-to-br from-highlight/50 to-secondary/50 p-1 shadow-2xl shadow-highlight/10 shrink-0">
                        <div class="w-full h-full rounded-2xl bg-highlight shrink-0 flex items-center justify-center text-primary font-black text-xl shadow-[0_0_15px_rgba(202,255,0,0.3)]">
                            <span class="text-3xl md:text-4xl font-black text-primary">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-black text-white uppercase tracking-tight">{{ $user->name }}</h3>
                        <p class="text-white/40 text-xs font-bold uppercase tracking-widest mt-1">{{ $user->email }}
                        </p>
                    </div>

                    <div class="w-full pt-6 border-t border-white/5 space-y-4">
                        <!-- Verification Status -->
                        {{-- <div class="flex items-center justify-between">
                            <span class="text-[10px] font-black text-white/30 uppercase tracking-[0.2em]">Verification</span>
                            @if ($user->hasVerifiedEmail())
                                <span class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-[10px] font-black uppercase tracking-widest border border-green-500/20 flex items-center gap-1 whitespace-nowrap">
                                    <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                    </svg>
                                    Verified
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-red-500/10 text-red-400 text-[10px] font-black uppercase tracking-widest border border-red-500/20 flex items-center gap-1 whitespace-nowrap">
                                    <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"></path>
                                    </svg>
                                    Pending
                                </span>
                            @endif
                        </div> --}}

                        <!-- 2FA Status -->
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-black text-white/30 uppercase tracking-[0.2em]">Security</span>
                            @if ($user->hasEnabledTwoFactorAuthentication())
                                <span class="px-3 py-1 rounded-full bg-highlight/10 text-highlight text-[10px] font-black uppercase tracking-widest border border-highlight/20 flex items-center gap-1 whitespace-nowrap">
                                    <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.040L3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622l-.382-3.016z"></path>
                                    </svg>
                                    2FA Active
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-white/5 text-white/40 text-[10px] font-black uppercase tracking-widest border border-white/10 flex items-center gap-1 whitespace-nowrap">
                                    <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Standard
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Email Verification CTA -->
            {{-- @if (!$user->hasVerifiedEmail())
                <div class="bg-red-500/10 border border-red-500/20 rounded-3xl p-6 space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-red-500/20 text-red-400 shrink-0 flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-black text-white uppercase tracking-tight">Verify your email</p>
                            <p class="text-xs text-white/60 leading-relaxed font-medium">You need to verify your email
                                address to access all features.</p>
                        </div>
                    </div>
                    <button wire:click="sendEmailVerification" wire:loading.attr="disabled"
                        class="w-full py-3 bg-red-500/20 hover:bg-red-500/30 text-red-400 rounded-xl font-black uppercase tracking-widest text-[10px] transition-all duration-300 disabled:opacity-50">
                        <span wire:loading.remove wire:target="sendEmailVerification">Send Verification Link</span>
                        <span wire:loading wire:target="sendEmailVerification">Sending...</span>
                    </button>
                </div>
            @endif --}}
        </div>

        <!-- Main Content: Forms -->
        <div class="lg:col-span-8 space-y-8">
            <!-- Personal Information -->
            <div class="bg-primary/40 backdrop-blur-xl border border-white/10 rounded-3xl p-8 md:p-10 space-y-8">
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-2xl bg-highlight/20 text-highlight flex items-center justify-center shadow-lg shadow-highlight/10 shrink-0">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-white uppercase tracking-widest">Personal Details</h3>
                        <p class="text-[10px] text-white/40 uppercase font-bold tracking-[0.2em] mt-1">Update your basic account information</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] ml-1">Full
                            Name</label>
                        <input type="text" wire:model="state.name"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-highlight focus:ring-1 focus:ring-highlight outline-none transition-all duration-300 font-medium">
                        <x-input-error for="name" class="mt-2" />
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] ml-1">Email
                            Address</label>
                        <input type="email" wire:model="state.email"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-highlight focus:ring-1 focus:ring-highlight outline-none transition-all duration-300 font-medium">
                        <x-input-error for="email" class="mt-2" />
                    </div>
                </div>

                <div class="flex justify-end pt-4 relative z-10">
                    <button wire:click="updateProfileInformation" class="w-full sm:w-auto px-10 py-4 bg-highlight text-primary rounded-xl font-black uppercase tracking-widest text-xs shadow-lg shadow-highlight/20 hover:scale-105 active:scale-95 transition-all duration-300">
                        Save Changes
                    </button>
                </div>
            </div>

            <!-- Password Update -->
            <div class="bg-primary/40 backdrop-blur-xl border border-white/10 rounded-3xl p-8 md:p-10 space-y-8 relative overflow-hidden group shadow-2xl">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-secondary/5 rounded-full blur-3xl group-hover:bg-secondary/10 transition-all duration-700"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-2xl bg-secondary/20 text-secondary flex items-center justify-center shadow-lg shadow-secondary/10 shrink-0">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-white uppercase tracking-widest">Update Password</h3>
                        <p class="text-[10px] text-white/40 uppercase font-bold tracking-[0.2em] mt-1">Ensure your account is using a long, random password</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative z-10">
                    <div class="space-y-2" x-data="{ show: false }">
                        <label class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] ml-1">Current Password</label>
                        <div class="relative group">
                            <input :type="show ? 'text' : 'password'" wire:model="passwordState.current_password"
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-highlight focus:ring-1 focus:ring-highlight outline-none transition-all duration-300 pr-12 font-medium">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-white/20 hover:text-highlight transition-colors duration-200 focus:outline-none">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error for="current_password" class="mt-2" />
                    </div>

                    <!-- New Password -->
                    <div class="space-y-2" x-data="{ show: false }">
                        <label class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] ml-1">New Password</label>
                        <div class="relative group">
                            <input :type="show ? 'text' : 'password'" wire:model="passwordState.password"
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-highlight focus:ring-1 focus:ring-highlight outline-none transition-all duration-300 pr-12 font-medium">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-white/20 hover:text-highlight transition-colors duration-200 focus:outline-none">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error for="password" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2" x-data="{ show: false }">
                        <label class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] ml-1">Confirm Password</label>
                        <div class="relative group">
                            <input :type="show ? 'text' : 'password'" wire:model="passwordState.password_confirmation"
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-highlight focus:ring-1 focus:ring-highlight outline-none transition-all duration-300 pr-12 font-medium">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-white/20 hover:text-highlight transition-colors duration-200 focus:outline-none">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error for="password_confirmation" class="mt-2" />
                    </div>
                </div>

                <div class="flex justify-end pt-4 relative z-10">
                    <button wire:click="updatePassword" class="w-full sm:w-auto px-10 py-4 bg-highlight text-primary rounded-xl font-black uppercase tracking-widest text-xs shadow-lg shadow-highlight/20 hover:scale-105 active:scale-95 transition-all duration-300">
                        Update Password
                    </button>
                </div>
            </div>

            <!-- Two-Factor Authentication -->
            <div class="bg-primary/40 backdrop-blur-xl border border-white/10 rounded-3xl p-8 md:p-10 space-y-8">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-2xl bg-highlight/20 text-highlight flex items-center justify-center shadow-lg shadow-highlight/10 shrink-0">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.040L3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622l-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-white uppercase tracking-widest">Two-Factor Authentication
                        </h3>
                        <p class="text-[10px] text-white/40 uppercase font-bold tracking-[0.2em] mt-1">Add additional
                            security using Two-Factor Authentication</p>
                    </div>
                </div>

                <div class="space-y-6">
                    @if (!$user->hasEnabledTwoFactorAuthentication() && !$showingQrCode)
                        <div class="p-6 rounded-2xl bg-white/5 border border-white/10 space-y-4">
                            <p class="text-sm text-white/60 font-medium">You have not enabled two-factor
                                authentication. When enabled, you will be prompted for a secure, random token during
                                authentication. You may retrieve this token from your phone's Google Authenticator
                                application.</p>
                            <button wire:click="enableTwoFactorAuthentication"
                                class="px-8 py-4 bg-highlight text-primary rounded-xl font-black uppercase tracking-widest text-xs hover:scale-105 transition-all duration-300">
                                Enable 2FA
                            </button>
                        </div>
                    @else
                        @if ($showingQrCode)
                            <div class="p-8 rounded-3xl bg-white/5 border border-white/10 space-y-6">
                                <div class="space-y-2">
                                    <p class="text-sm font-black text-white uppercase tracking-tight">Finish Enabling
                                        2FA</p>
                                    <p class="text-xs text-white/60 font-medium">To finish enabling two-factor
                                        authentication, scan the following QR code using your phone's authenticator
                                        application or enter the set-up key and provide the generated OTP code.</p>
                                </div>

                                <div class="flex flex-col md:flex-row items-center gap-8">
                                    <div class="bg-white p-4 rounded-2xl inline-block shadow-2xl">
                                        {!! $user->twoFactorQrCodeSvg() !!}
                                    </div>

                                    <div class="space-y-4 flex-1">
                                        <div class="p-4 rounded-2xl bg-white/5 border border-white/10 space-y-2 relative group/copy" x-data="{ copied: false }">
                                            <div class="flex items-center justify-between">
                                                <p class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em]">Setup Key</p>
                                                <button @click="navigator.clipboard.writeText('{{ decrypt($user->two_factor_secret) }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                                    class="text-highlight hover:scale-110 active:scale-95 transition-all duration-200">
                                                    <svg x-show="!copied" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                    </svg>
                                                    <svg x-show="copied" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <p class="text-sm font-mono text-highlight break-all select-all pr-8">
                                                {{ decrypt($user->two_factor_secret) }}</p>
                                        </div>
                                        <p class="text-[10px] text-white/40 font-medium leading-relaxed italic">Enter
                                            this key into your authenticator app if you are unable to scan the QR code.
                                        </p>
                                    </div>
                                </div>

                                <div class="space-y-4 max-w-sm">
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em]">Confirmation
                                            Code</label>
                                        <input type="text" wire:model="code"
                                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:border-highlight outline-none"
                                            placeholder="000000">
                                        <x-input-error for="code" class="mt-2" />
                                    </div>
                                    <button wire:click="confirmTwoFactorAuthentication"
                                        class="px-8 py-4 bg-highlight text-primary rounded-xl font-black uppercase tracking-widest text-xs">
                                        Confirm 2FA
                                    </button>
                                </div>
                            </div>
                        @elseif ($showingRecoveryCodes)
                            <div class="p-8 rounded-3xl bg-white/5 border border-white/10 space-y-6">
                                <div class="space-y-2">
                                    <p class="text-sm font-black text-white uppercase tracking-tight">Store Recovery
                                        Codes</p>
                                    <p class="text-xs text-white/60 font-medium">Store these recovery codes in a secure
                                        password manager. They can be used to recover access to your account if your
                                        two-factor authentication device is lost.</p>
                                </div>

                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 gap-2 bg-black/20 p-6 rounded-2xl font-mono text-sm text-highlight">
                                    @foreach (json_decode(decrypt($user->two_factor_recovery_codes), true) as $code)
                                        <div>{{ $code }}</div>
                                    @endforeach
                                </div>

                                <div class="flex gap-4">
                                    <button wire:click="regenerateRecoveryCodes"
                                        class="px-6 py-3 bg-white/5 border border-white/10 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-white/10 transition-colors">
                                        Regenerate
                                    </button>
                                    <button wire:click="$set('showingRecoveryCodes', false)"
                                        class="px-6 py-3 bg-highlight text-primary rounded-xl text-[10px] font-black uppercase tracking-widest hover:scale-105 transition-all">
                                        Done
                                    </button>
                                </div>
                            </div>
                        @else
                            <div
                                class="p-8 rounded-3xl bg-white/5 border border-white/10 flex flex-col md:flex-row items-center justify-between gap-6">
                                <div class="space-y-1 text-center md:text-left">
                                    <p class="text-sm font-black text-white uppercase tracking-tight">2FA is Enabled
                                    </p>
                                    <p class="text-xs text-white/40 font-medium">Your account is secured with
                                        two-factor authentication.</p>
                                </div>
                                <div class="flex gap-3">
                                    <button wire:click="showRecoveryCodes"
                                        class="px-6 py-3 bg-white/5 border border-white/10 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-white/10 transition-colors">
                                        Show Codes
                                    </button>
                                    <button wire:click="disableTwoFactorAuthentication"
                                        class="px-6 py-3 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-500/20 transition-colors">
                                        Disable 2FA
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notifications -->
    <div x-data="{ show: false, message: '' }"
        x-on:saved.window="show = true; message = 'Changes saved successfully'; setTimeout(() => show = false, 3000)"
        x-on:verification-link-sent.window="show = true; message = 'Verification link sent'; setTimeout(() => show = false, 3000)"
        x-on:two-factor-enabled.window="show = true; message = '2FA enabled successfully'; setTimeout(() => show = false, 3000)"
        x-on:two-factor-disabled.window="show = true; message = '2FA disabled successfully'; setTimeout(() => show = false, 3000)"
        x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4" class="fixed bottom-10 right-10 z-50" x-cloak>
        <div
            class="bg-highlight text-primary px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] shadow-[0_10px_40px_rgba(202,255,0,0.4)] flex items-center gap-3">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd"></path>
            </svg>
            <span x-text="message"></span>
        </div>
    </div>
</div>
