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
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="bg-primary min-h-screen text-white font-sans overflow-x-hidden antialiased" x-data="{ sidebarOpen: false, sidebarCollapsed: false }">
    <div class="flex min-h-screen">

        <!-- Mobile Sidebar Backdrop -->
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm md:hidden"></div>

        <!-- Sidebar Container -->
        <aside :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full', sidebarCollapsed ? 'md:w-20' : 'md:w-72']"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-primary/95 backdrop-blur-2xl border-r border-white/10 flex flex-col transition-all duration-300 ease-in-out md:translate-x-0 md:static md:flex-shrink-0 shadow-[4px_0_24px_rgba(0,0,0,0.3)]">

            <!-- Brand/Logo -->
            <div class="flex items-center justify-center h-24 border-b border-white/10 px-6 relative">
                <button @click="sidebarOpen = false"
                    class="absolute right-4 md:hidden text-white/70 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <a href="{{ route('home') }}" class="flex flex-col items-center overflow-hidden">
                    <span x-show="!sidebarCollapsed"
                        class="text-2xl font-heading font-black text-white tracking-widest drop-shadow-md uppercase whitespace-nowrap">CAPEU
                        2026</span>
                    <span x-show="sidebarCollapsed" x-cloak
                        class="text-2xl font-heading font-black text-highlight drop-shadow-md absolute">C</span>
                    <span x-show="!sidebarCollapsed"
                        class="text-xs font-heading font-bold text-highlight tracking-widest uppercase mt-1">Dashboard</span>
                </a>

                <!-- Desktop Collapse Toggle -->
                <button @click="sidebarCollapsed = !sidebarCollapsed"
                    class="hidden md:flex absolute -right-3 top-8 bg-primary border border-white/10 rounded-full p-1 text-white/70 hover:text-white hover:border-white/30 hover:bg-primary/80 transition-all shadow-lg z-10">
                    <svg class="w-4 h-4 transition-transform duration-300" :class="sidebarCollapsed ? 'rotate-180' : ''"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 py-8 space-y-3 overflow-y-auto overflow-x-hidden font-sans"
                :class="sidebarCollapsed ? 'px-2' : 'px-4'">
                @php
                    $navItems = [
                        [
                            'name' => 'Dashboard',
                            'route' => 'dashboard',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />',
                        ],
                        [
                            'name' => 'Profile',
                            'route' => 'profile.show',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />',
                        ],
                    ];
                @endphp

                @foreach ($navItems as $item)
                    @php
                        $isActive = Route::has($item['route']) && request()->routeIs($item['route'] . '*');
                    @endphp
                    <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
                        class="flex items-center rounded-2xl transition-all duration-300 group
                       {{ $isActive ? 'bg-white/10 border border-white/20 shadow-[0_0_15px_rgba(202,255,0,0.15)] text-highlight' : 'text-white/70 hover:bg-white/5 hover:text-white border border-transparent' }}"
                        :class="sidebarCollapsed ? 'justify-center py-3' : 'px-4 py-3 gap-3'"
                        title="{{ $item['name'] }}">
                        <svg class="w-6 h-6 flex-shrink-0 {{ $isActive ? 'text-highlight' : 'text-white/40 group-hover:text-white/80' }} transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $item['icon'] !!}
                        </svg>
                        <span x-show="!sidebarCollapsed"
                            class="font-heading font-bold text-sm tracking-wide whitespace-nowrap">{{ $item['name'] }}</span>
                        @if ($isActive)
                            <div x-show="!sidebarCollapsed"
                                class="ml-auto w-1.5 h-1.5 rounded-full flex-shrink-0 bg-highlight shadow-[0_0_8px_rgba(202,255,0,0.8)]">
                            </div>
                        @endif
                    </a>
                @endforeach
            </nav>

            <!-- User Profile & Logout -->
            <div class="p-4 border-t border-white/10">
                <div class="flex flex-col" :class="sidebarCollapsed ? 'gap-2 items-center' : 'gap-4'">
                    @auth
                        <div class="flex items-center gap-3 px-2 w-full"
                            :class="sidebarCollapsed ? 'justify-center px-0' : ''">
                            <div class="w-10 h-10 rounded-full bg-highlight/20 border border-highlight/30 flex items-center justify-center text-highlight font-heading font-bold overflow-hidden shadow-[0_0_10px_rgba(202,255,0,0.15)] flex-shrink-0"
                                :title="sidebarCollapsed ? '{{ Auth::user()->name }}' : ''">
                                @if (Auth::user()->profile_photo_path)
                                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                @endif
                            </div>
                            <div x-show="!sidebarCollapsed" class="flex-1 min-w-0">
                                <p class="text-sm font-heading font-bold text-white truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-white/50 truncate font-sans">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    @endauth

                    <form method="POST" action="{{ route('logout') }}" x-data class="w-full">
                        @csrf
                        <button type="submit" @click.prevent="$root.submit();"
                            class="flex items-center justify-center gap-2 rounded-xl border border-white/10 text-white/80 hover:bg-red-500/20 hover:text-red-400 hover:border-red-500/50 transition-all duration-300 w-full"
                            :class="sidebarCollapsed ? 'py-3' : 'px-4 py-2.5'"
                            :title="sidebarCollapsed ? 'Sign Out' : ''">
                            <svg class="flex-shrink-0" :class="sidebarCollapsed ? 'w-5 h-5' : 'w-4 h-4'" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span x-show="!sidebarCollapsed"
                                class="font-heading font-bold text-sm whitespace-nowrap">Sign Out</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 bg-white/5 backdrop-blur-sm">

            <!-- Mobile Header with Hamburger -->
            <header
                class="md:hidden flex items-center justify-between h-20 px-6 border-b border-white/10 bg-primary/95 backdrop-blur-2xl z-30">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true"
                        class="text-white/80 hover:text-highlight transition focus:outline-none">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </button>
                    <span class="font-heading font-bold text-lg text-white">CAPEU 2026</span>
                </div>
            </header>

            <!-- Page Header (Optional) -->
            @if (isset($header))
                <header class="hidden md:block py-6 px-8 border-b border-white/10 bg-primary/40 backdrop-blur-xs">
                    {{ $header }}
                </header>
            @endif

            <!-- Content Slot -->
            <main class="flex-1 p-6 md:p-8 overflow-y-auto">
                <div class="max-w-7xl mx-auto">
                    {{-- {{ $slot }} --}}
                </div>
            </main>

        </div>
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('swal:alert', event => {
            const data = event.detail[0];
            Swal.fire({
                icon: data.type,
                title: data.title,
                text: data.text,
                confirmButtonColor: '#0139CC',
                background: '#0139CC',
                color: '#ffffff',
            });
        });
    </script>
</body>

</html>
