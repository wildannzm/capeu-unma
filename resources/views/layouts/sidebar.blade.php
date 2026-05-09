<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    <meta name="description" content="{{ $description ?? 'CAPEU 2026 International Mobility Program Dashboard.' }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-primary text-white selection:bg-highlight selection:text-primary">
    <!-- Decorative Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-secondary/10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-highlight/5 rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2">
        </div>
    </div>

    <div x-data="{ sidebarOpen: false, sidebarCollapsed: false }" class="relative min-h-screen md:flex z-10">

        <!-- Mobile Navigation Bar -->
        <div
            class="bg-primary/80 backdrop-blur-md text-white flex justify-between md:hidden items-center p-4 sticky top-0 z-40 border-b border-white/10">
            <a href="{{ route('dashboard') }}" class="font-heading font-black text-xl tracking-wider uppercase">
                CAPEU <span class="text-highlight">2026</span>
            </a>
            <button @click="sidebarOpen = !sidebarOpen"
                class="p-2 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Sidebar Overlay (Mobile) -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
            class="fixed inset-0 bg-primary/60 backdrop-blur-sm z-40 md:hidden" x-cloak></div>

        <!-- Sidebar -->
        <aside
            :class="{
                'translate-x-0': sidebarOpen,
                '-translate-x-full': !sidebarOpen,
                'md:w-72': !sidebarCollapsed,
                'md:w-24': sidebarCollapsed
            }"
            class="fixed inset-y-0 left-0 z-50 bg-primary/50 backdrop-blur-xl border-r border-white/10 transition-all duration-300 transform flex flex-col h-full md:relative md:translate-x-0 md:h-screen md:sticky md:top-0 shadow-2xl overflow-visible"
            x-cloak>

            <div class="p-8 flex-shrink-0 flex items-center relative"
                :class="sidebarCollapsed ? 'justify-center' : 'justify-between'">
                <a href="{{ route('dashboard') }}" x-show="!sidebarCollapsed"
                    x-transition:enter="duration-300 opacity-0" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    class="font-heading font-black text-3xl tracking-tighter flex items-center hover:scale-105 transition-transform duration-300 outline-none focus:outline-none">
                    <span class="text-white">CAPEU</span>
                    <span class="text-highlight ml-1">2026</span>
                </a>

                <!-- Desktop Collapse Toggle (Floating Circle) -->
                <button @click="sidebarCollapsed = !sidebarCollapsed"
                    class="hidden md:flex absolute -right-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-highlight text-primary items-center justify-center shadow-[0_0_15px_rgba(202,255,0,0.4)] border border-white/20 z-50 hover:scale-110 transition-all duration-300 group/collapse outline-none focus:outline-none">
                    <svg class="w-4 h-4 transition-transform duration-500" :class="sidebarCollapsed ? 'rotate-180' : ''"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <button @click="sidebarOpen = false"
                    class="md:hidden w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white/40 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar" :class="sidebarCollapsed ? 'px-4' : 'px-8'">
                <nav class="space-y-3">
                    @php
                        $isAdmin = auth()->user()->hasRole('admin');
                    @endphp

                    <!-- Dashboard / Overview -->
                    <a href="{{ $isAdmin ? route('admin.dashboard') : route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'bg-highlight text-primary shadow-[0_0_20px_rgba(202,255,0,0.25)]' : 'text-white/60 hover:bg-white/5 hover:text-white' }} flex items-center py-4 rounded-2xl transition-all duration-300 group outline-none focus:outline-none overflow-hidden"
                        :class="sidebarCollapsed ? 'px-0 justify-center' : 'px-5'">
                        <svg class="w-5 h-5 transition-colors duration-300 {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-white/40 group-hover:text-highlight' }} {{ !(request()->routeIs('dashboard') || request()->routeIs('admin.dashboard')) ? 'group-hover:scale-110' : '' }}"
                            :class="sidebarCollapsed ? '' : 'mr-4'" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition:enter="delay-150 duration-300 opacity-0"
                            class="font-bold uppercase tracking-widest text-xs whitespace-nowrap">Overview</span>
                    </a>

                    @if (!$isAdmin)
                        <a href="{{ route('profile') }}"
                            class="{{ request()->routeIs('profile') ? 'bg-highlight text-primary shadow-[0_0_20px_rgba(202,255,0,0.25)]' : 'text-white/60 hover:bg-white/5 hover:text-white' }} flex items-center py-4 rounded-2xl transition-all duration-300 group outline-none focus:outline-none overflow-hidden"
                            :class="sidebarCollapsed ? 'px-0 justify-center' : 'px-5'">
                            <svg class="w-5 h-5 transition-colors duration-300 {{ request()->routeIs('profile') ? 'text-primary' : 'text-white/40 group-hover:text-highlight' }} {{ !request()->routeIs('profile') ? 'group-hover:scale-110' : '' }}"
                                :class="sidebarCollapsed ? '' : 'mr-4'" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span x-show="!sidebarCollapsed" x-transition:enter="delay-150 duration-300 opacity-0"
                                class="font-bold uppercase tracking-widest text-xs whitespace-nowrap">Profile</span>
                        </a>
                    @endif

                    @if ($isAdmin)
                        <div class="pt-6 pb-2" x-show="!sidebarCollapsed">
                            <p class="text-[10px] font-black text-white/20 uppercase tracking-[0.3em] px-5">Management
                            </p>
                        </div>

                        <a href="{{ route('admin.payments') }}"
                            class="{{ request()->routeIs('admin.payments') ? 'bg-highlight text-primary shadow-[0_0_20px_rgba(202,255,0,0.25)]' : 'text-white/60 hover:bg-white/5 hover:text-white' }} flex items-center py-4 rounded-2xl transition-all duration-300 group outline-none focus:outline-none overflow-hidden"
                            :class="sidebarCollapsed ? 'px-0 justify-center' : 'px-5'">
                            <svg class="w-5 h-5 transition-colors duration-300 {{ request()->routeIs('admin.payments') ? 'text-primary' : 'text-white/40 group-hover:text-highlight' }} {{ !request()->routeIs('admin.payments') ? 'group-hover:scale-110' : '' }}"
                                :class="sidebarCollapsed ? '' : 'mr-4'" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>
                            <span x-show="!sidebarCollapsed" x-transition:enter="delay-150 duration-300 opacity-0"
                                class="font-bold uppercase tracking-widest text-xs whitespace-nowrap">Payments</span>
                        </a>

                        <a href="{{ route('admin.registrations') }}"
                            class="{{ request()->routeIs('admin.registrations') ? 'bg-highlight text-primary shadow-[0_0_20px_rgba(202,255,0,0.25)]' : 'text-white/60 hover:bg-white/5 hover:text-white' }} flex items-center py-4 rounded-2xl transition-all duration-300 group outline-none focus:outline-none overflow-hidden"
                            :class="sidebarCollapsed ? 'px-0 justify-center' : 'px-5'">
                            <svg class="w-5 h-5 transition-colors duration-300 {{ request()->routeIs('admin.registrations') ? 'text-primary' : 'text-white/40 group-hover:text-highlight' }} {{ !request()->routeIs('admin.registrations') ? 'group-hover:scale-110' : '' }}"
                                :class="sidebarCollapsed ? '' : 'mr-4'" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span x-show="!sidebarCollapsed" x-transition:enter="delay-150 duration-300 opacity-0"
                                class="font-bold uppercase tracking-widest text-xs whitespace-nowrap">Registrations</span>
                        </a>
                    @endif
                </nav>
            </div>

            <div class="mt-auto p-8 border-t border-white/5 bg-white/5 backdrop-blur-md flex-shrink-0">
                <div class="flex items-center" :class="sidebarCollapsed ? 'justify-center' : 'mb-6'">
                    <div
                        class="w-12 h-12 rounded-2xl bg-highlight flex-shrink-0 flex items-center justify-center text-primary font-black text-xl shadow-[0_0_15px_rgba(202,255,0,0.3)]">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div x-show="!sidebarCollapsed" x-transition:enter="delay-150 duration-300 opacity-0"
                        class="ml-4 overflow-hidden">
                        <p class="text-sm font-black text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-white/40 truncate uppercase tracking-widest">
                            {{ auth()->user()->email }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" x-data x-show="!sidebarCollapsed"
                    x-transition:enter="delay-150 duration-300 opacity-0">
                    @csrf
                    <button type="submit" @click.prevent="$root.submit();"
                        class="flex items-center text-[10px] font-black uppercase tracking-[0.2em] text-white/40 hover:text-red-400 transition-[color] duration-300 w-full text-left outline-none focus:outline-none focus:ring-0">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0 overflow-auto relative">
            <!-- Top Nav (Desktop) -->
            <header
                class="hidden md:flex bg-primary/40 backdrop-blur-md border-b border-white/10 h-20 items-center px-10 justify-between sticky top-0 z-30">
                <h1 class="font-heading font-black text-xl text-white uppercase tracking-widest">
                    {{ $header ?? 'Dashboard' }}
                </h1>
                @if (!$isAdmin)
                    <div class="flex items-center space-x-6">
                        @php
                            $latestReg = auth()->user()->registrations()->latest()->first();
                            $statusConfig = match ($latestReg?->status) {
                                'accepted' => [
                                    'bg' => 'bg-green-500/10',
                                    'text' => 'text-green-400',
                                    'border' => 'border-green-500/20',
                                ],
                                'rejected' => [
                                    'bg' => 'bg-red-500/10',
                                    'text' => 'text-red-400',
                                    'border' => 'border-red-500/20',
                                ],
                                'reviewed', 'verified' => [
                                    'bg' => 'bg-yellow-500/10',
                                    'text' => 'text-yellow-400',
                                    'border' => 'border-yellow-500/20',
                                ],
                                'payment_verified' => [
                                    'bg' => 'bg-highlight/10',
                                    'text' => 'text-highlight',
                                    'border' => 'border-highlight/20',
                                ],
                                'submitted' => [
                                    'bg' => 'bg-orange-500/10',
                                    'text' => 'text-orange-400',
                                    'border' => 'border-orange-500/20',
                                ],
                                default => [
                                    'bg' => 'bg-white/5',
                                    'text' => 'text-white/40',
                                    'border' => 'border-white/10',
                                ],
                            };
                        @endphp
                        <span
                            class="text-[10px] font-black px-4 py-2 rounded-full border {{ $statusConfig['border'] }} {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} uppercase tracking-[0.2em]">
                            Status: {{ in_array($latestReg?->status, ['reviewed', 'verified']) ? 'Verified' : str_replace('_', ' ', $latestReg?->status ?? 'Draft') }}
                        </span>
                    </div>
                @endif
            </header>

            <div class="p-6 md:p-10 relative">
                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
