<div class="bg-primary min-h-screen text-white font-sans overflow-x-hidden">
    <!-- Navbar -->
    <header x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="scrolled ? 'py-3 sm:py-4 bg-primary/95 shadow-lg border-white/10' :
            'py-5 sm:py-6 bg-transparent border-transparent'"
        class="fixed top-0 left-0 w-full z-50 backdrop-blur-md border-b transition-all duration-500">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4">
            <div
                class="text-xl sm:text-2xl font-heading font-bold text-white tracking-wider flex-shrink-0 whitespace-nowrap">
                CAPEU 2026
            </div>
            <div class="flex items-center space-x-3 sm:space-x-4 flex-shrink-0">
                @auth
                    @php
                        $dashboardRoute = auth()->user()->hasRole('admin')
                            ? route('admin.dashboard')
                            : route('dashboard');
                    @endphp
                    <a href="{{ $dashboardRoute }}"
                        class="bg-accent text-primary font-bold px-4 sm:px-5 py-1.5 sm:py-2 rounded-full hover:bg-highlight transition shadow-lg text-sm sm:text-base whitespace-nowrap">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-white hover:text-accent transition font-semibold text-sm sm:text-base whitespace-nowrap">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-accent text-primary font-bold px-4 sm:px-5 py-1.5 sm:py-2 rounded-full hover:bg-highlight transition shadow-lg text-sm sm:text-base whitespace-nowrap">Register
                        Now!</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="pt-24 sm:pt-28">
        <!-- Section 1: Hero & Highlights -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 pb-20 relative">
            <div
                class="text-center mb-16 relative z-10 flex flex-col items-center w-full overflow-hidden space-y-2 lg:space-y-4">
                <!-- Main Header text -->
                <h1
                    class="text-[clamp(1.25rem,6vw,3.75rem)] font-heading font-black text-white drop-shadow-md whitespace-nowrap leading-none">
                    International Mobility
                </h1>

                <!-- CAPEU 2026 -->
                <div class="relative flex justify-center items-center">
                    <span
                        class="font-heading font-black text-highlight text-[clamp(2.5rem,12vw,7rem)] leading-none drop-shadow-[0_5px_5px_rgba(0,0,0,0.5)] z-10 whitespace-nowrap">
                        CAPEU 2026
                    </span>
                </div>

                <!-- Subtitle -->
                <div
                    class="font-heading font-black text-accent text-2xl md:text-3xl lg:text-4xl tracking-widest drop-shadow-[0_2px_2px_rgba(0,0,0,0.4)] leading-none">
                    ASPIRE UNMA
                </div>
            </div>

            <!-- Information Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 relative z-10 max-w-5xl mx-auto mt-16">

                <!-- Highlights -->
                <div class="flex flex-col">
                    <h2 class="text-white font-heading font-bold text-3xl mb-3 drop-shadow-md">Highlights.</h2>
                    <div
                        class="bg-[#1D60CB] rounded-xl p-8 flex-grow flex flex-col justify-center space-y-6 shadow-xl border border-white/10">
                        <div
                            class="text-center font-heading font-bold italic text-white text-xl lg:text-2xl leading-tight">
                            International Mobility<br>Programme Certificate</div>
                        <div
                            class="text-center font-heading font-bold italic text-white text-xl lg:text-2xl leading-tight">
                            Cultural Exchange &<br>Service Learning</div>
                        <div
                            class="text-center font-heading font-bold italic text-white text-xl lg:text-2xl leading-tight">
                            Exciting Outdoor &<br>Community Activities</div>
                    </div>
                </div>

                <!-- Right Column (Fee & Date) -->
                <div class="flex flex-col space-y-8">
                    <!-- Participation Fee -->
                    <div>
                        <h2 class="text-white font-heading font-bold text-3xl mb-3 drop-shadow-md">Participation Fee.
                        </h2>
                        <div
                            class="rounded-xl flex flex-col sm:flex-row shadow-xl overflow-hidden font-heading font-bold text-lg lg:text-xl border border-white/10">
                            <div
                                class="bg-gradient-to-r from-[#4C8EDB] to-[#71A8E2] text-white px-4 py-4 sm:w-1/2 flex items-center justify-center text-center whitespace-nowrap">
                                150 USD Non Member
                            </div>
                            <div
                                class="bg-gradient-to-r from-[#CAFF00] to-[#E6FF00] text-[#0139CC] px-4 py-4 sm:w-1/2 flex items-center justify-center text-center whitespace-nowrap">
                                130 USD Member
                            </div>
                        </div>
                        <div class="mt-4 flex justify-center sm:justify-end">
                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 border border-white/20 rounded-full backdrop-blur-sm shadow-sm">
                                <span class="font-sans font-medium text-sm text-white tracking-wide">
                                    Latest registration until <strong class="text-highlight font-bold">August 5,
                                        2026</strong>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Date & Register -->
                    <div
                        class="bg-[#1D60CB] rounded-xl p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between shadow-xl flex-grow border border-white/10">
                        <div
                            class="flex flex-col justify-center items-center sm:items-start text-center sm:text-left mb-6 sm:mb-0 sm:border-r-2 border-white/30 sm:pr-8 w-full sm:w-2/3">
                            <div
                                class="font-heading font-black text-accent text-6xl sm:text-7xl leading-none tracking-tighter drop-shadow-md">
                                23 - 28</div>
                            <div class="font-heading font-black text-white text-4xl sm:text-5xl mt-1 drop-shadow-md">Aug
                                2026</div>
                            <div class="font-heading font-bold text-accent text-sm sm:text-base mt-2 leading-snug">
                                Majalengka, West Java,<br>Indonesia</div>
                        </div>
                        <div class="sm:pl-8 w-full sm:w-1/3 flex justify-center items-center">
                            <a href="#"
                                class="text-white font-heading font-bold text-xl hover:text-accent transition">Register
                                Now</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Section 2: Participants' Benefit -->
        <section class="py-24 lg:py-32 relative overflow-hidden bg-[#0139CC]">
            <!-- Decorative Cloud Background Patterns -->
            <div class="absolute inset-0 pointer-events-none opacity-50">
                <div
                    class="absolute -top-[10%] -right-[5%] w-[800px] h-[800px] rounded-[40%] bg-[#2A76D8]/40 blur-3xl transform rotate-12">
                </div>
                <div
                    class="absolute top-[20%] -left-[10%] w-[1000px] h-[1000px] rounded-[35%] bg-[#2A76D8]/30 blur-3xl transform -rotate-12">
                </div>
                <div
                    class="absolute top-[60%] right-[5%] w-[600px] h-[600px] rounded-[45%] bg-[#2A76D8]/30 blur-3xl transform rotate-45">
                </div>
                <div
                    class="absolute -bottom-[10%] -left-[5%] w-[800px] h-[800px] rounded-[40%] bg-[#2A76D8]/40 blur-3xl transform -rotate-6">
                </div>
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-12 max-w-7xl relative z-10">
                <!-- Top Section -->
                <div class="flex flex-col items-center justify-center mb-20 md:mb-32 relative">
                    <h2
                        class="text-4xl md:text-5xl lg:text-[4.5rem] font-heading font-black text-white drop-shadow-lg z-20 tracking-tight leading-none mb-2 md:mb-4">
                        Participants'
                    </h2>
                    <div class="relative z-30">
                        <div
                            class="font-heading font-black text-highlight text-5xl sm:text-7xl md:text-8xl lg:text-[7rem] drop-shadow-[0_5px_5px_rgba(0,0,0,0.5)] z-10">
                            Benefit</div>
                    </div>
                    <div
                        class="font-heading font-black text-accent text-4xl md:text-5xl mt-2 tracking-wide drop-shadow-md"">
                        What We Provide..
                    </div>
                </div>

                <!-- Items List -->
                <div class="flex flex-col space-y-20 md:space-y-32">

                    <!-- Item 1: Transportation -->
                    <div class="flex flex-col md:flex-row items-center gap-8 md:gap-16">
                        <div class="w-full md:w-5/12 flex-shrink-0">
                            <div
                                class="relative w-full aspect-[4/3] rounded-3xl md:rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] overflow-hidden group">
                                <img src="{{ asset('assets/images/transportation.png') }}" alt="Transportation"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 rounded-3xl md:rounded-[3rem] border-4 md:border-[6px] border-dashed border-highlight pointer-events-none z-10">
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-7/12 text-left">
                            <h3
                                class="font-heading font-black text-4xl md:text-5xl lg:text-7xl text-white mb-4 tracking-tight drop-shadow-md">
                                Transportation</h3>
                            <p
                                class="font-sans text-highlight font-bold text-xl md:text-2xl lg:text-3xl leading-snug drop-shadow-sm">
                                Airport Soekarno Hatta Airport (CGK) – UNMA Arrival & Departure<br>
                                Cirebon Station (CN) – UNMA
                            </p>
                        </div>
                    </div>

                    <!-- Item 2: Programme Kit -->
                    <div class="flex flex-col md:flex-row-reverse items-center gap-8 md:gap-16">
                        <div class="w-full md:w-5/12 flex-shrink-0">
                            <div
                                class="relative w-full aspect-[4/3] rounded-3xl md:rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] overflow-hidden group bg-white/5">
                                <img src="{{ asset('assets/images/vest.png') }}" alt="Programme Kit"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 rounded-3xl md:rounded-[3rem] border-4 md:border-[6px] border-dashed border-highlight pointer-events-none z-10">
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-7/12 text-left md:text-right">
                            <h3
                                class="font-heading font-black text-4xl md:text-5xl lg:text-7xl text-white mb-4 tracking-tight drop-shadow-md">
                                Programme Kit</h3>
                            <ul
                                class="font-sans text-highlight font-bold text-xl md:text-2xl lg:text-3xl leading-relaxed drop-shadow-sm space-y-2">
                                <li>1x Programme Vest, T-Shirt, Boonie Hat</li>
                                <li>1x Programme Lanyard with Participants' Tag</li>
                                <li>1x Digital Mobility Programme Certificate</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Item 3: Adventure Activities -->
                    <div class="flex flex-col md:flex-row items-center gap-8 md:gap-16">
                        <div class="w-full md:w-5/12 flex-shrink-0">
                            <div
                                class="relative w-full aspect-[4/3] rounded-3xl md:rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] overflow-hidden group">
                                <img src="{{ asset('assets/images/adventure.png') }}" alt="Adventure Activities"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 rounded-3xl md:rounded-[3rem] border-4 md:border-[6px] border-dashed border-highlight pointer-events-none z-10">
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-7/12 text-left">
                            <h3
                                class="font-heading font-black text-4xl md:text-5xl lg:text-7xl text-white mb-3 tracking-tight drop-shadow-md">
                                Adventure Activities</h3>
                            <div
                                class="font-sans text-highlight font-black text-2xl md:text-3xl lg:text-4xl mb-6 drop-shadow-sm">
                                Inclusive In Participation Fee!</div>
                            <ul
                                class="font-sans text-highlight font-bold text-xl md:text-2xl lg:text-3xl leading-relaxed drop-shadow-sm space-y-2">
                                <li>- Exploring Pasar Bumi Pakuwon</li>
                                <li>- Cikadongdong River Tubing</li>
                                <li>- Exploration Situ Cipanten</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Item 4: Networking Session -->
                    <div class="flex flex-col md:flex-row-reverse items-center gap-8 md:gap-16">
                        <div class="w-full md:w-5/12 flex-shrink-0">
                            <div
                                class="relative w-full aspect-[4/3] rounded-3xl md:rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] overflow-hidden group">
                                <img src="{{ asset('assets/images/networking.png') }}" alt="Networking Session"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 rounded-3xl md:rounded-[3rem] border-4 md:border-[6px] border-dashed border-highlight pointer-events-none z-10">
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-7/12 text-left md:text-right">
                            <h3
                                class="font-heading font-black text-4xl md:text-5xl lg:text-7xl text-white mb-3 tracking-tight drop-shadow-md">
                                Networking Session</h3>
                            <div
                                class="font-sans text-highlight font-black text-2xl md:text-3xl lg:text-4xl mb-6 drop-shadow-sm">
                                But We Make It Laidback & Outdoor</div>
                            <ul
                                class="font-sans text-highlight font-bold text-xl md:text-2xl lg:text-3xl leading-relaxed drop-shadow-sm space-y-2">
                                <li>Campire & BBQ Networking</li>
                                <li>Global Buddies Networking Sessions</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Item 5: Hiking -->
                    <div class="flex flex-col md:flex-row items-center gap-8 md:gap-16 relative">
                        <div class="w-full md:w-5/12 flex-shrink-0 relative z-20">
                            <div
                                class="relative w-full aspect-[4/3] rounded-3xl md:rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] overflow-hidden group">
                                <img src="{{ asset('assets/images/hiking.png') }}" alt="Hiking"
                                    class="absolute inset-0 w-full h-full object-cover scale-[1.25] md:scale-[1.3] transition-transform duration-700 group-hover:scale-[1.35] md:group-hover:scale-[1.4]">
                                <div
                                    class="absolute inset-0 rounded-3xl md:rounded-[3rem] border-4 md:border-[6px] border-dashed border-highlight pointer-events-none z-10">
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-7/12 text-left relative z-20">
                            <h3
                                class="font-heading font-black text-4xl md:text-5xl lg:text-7xl text-white mb-3 tracking-tight drop-shadow-md">
                                Hiking</h3>
                            <div
                                class="font-sans text-highlight font-black text-2xl md:text-3xl lg:text-4xl mb-6 drop-shadow-sm">
                                Once In a Lifetime Experience!</div>
                            <p
                                class="font-sans text-highlight font-bold text-xl md:text-2xl lg:text-3xl leading-relaxed drop-shadow-sm">
                                Hiking from Sampora Hill to<br>Ciranca Lake
                            </p>
                        </div>

                    </div>

                    <!-- And Many More!! (Both Mobile & Desktop) -->
                    <div class="flex justify-end mt-12 md:mt-24 lg:mt-32 w-full relative z-10 lg:pr-12">
                        <h3 class="font-heading italic font-black text-[4rem] md:text-[6rem] lg:text-[8rem] text-white transform -rotate-6 text-right leading-none pb-8"
                            style="filter: drop-shadow(5px 5px 15px rgba(0,0,0,0.5));">
                            And Many<br>More!!
                        </h3>
                    </div>
                </div>

            </div>
        </section>

        <!-- Section 3: Itinerary / Activities -->
        <section class="py-20 relative border-t border-white/10">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
                <div class="text-center mb-16 relative">
                    <h2 class="text-4xl md:text-5xl font-heading font-black text-white drop-shadow-md">Exciting</h2>
                    <div
                        class="font-heading font-black text-highlight text-5xl sm:text-7xl md:text-8xl lg:text-[7rem] drop-shadow-[0_5px_5px_rgba(0,0,0,0.5)] z-10">
                        Activities</div>
                    <div
                        class="font-heading font-black text-accent text-4xl md:text-5xl mt-2 tracking-wide drop-shadow-md">
                        Awaits!</div>
                </div>

                <!-- Photo Collage -->
                <div class="relative w-full max-w-7xl mx-auto mb-20 mt-12 hidden md:block px-4 lg:px-8">
                    <div class="grid grid-cols-4 gap-6 lg:gap-12 relative z-10">
                        <!-- Photo 1 -->
                        <div
                            class="transform -rotate-[6deg] hover:rotate-0 hover:scale-105 transition-all duration-300 ease-out mt-4">
                            <div class="bg-white p-2 md:p-3 rounded-[1.5rem] shadow-2xl">
                                <img src="{{ asset('assets/images/activities-1.png') }}" alt="Activity 1"
                                    class="w-full h-32 md:h-40 lg:h-64 object-cover rounded-[1rem]">
                            </div>
                        </div>
                        <!-- Photo 2 -->
                        <div
                            class="transform rotate-[4deg] translate-y-4 lg:translate-y-8 hover:rotate-0 hover:scale-105 transition-all duration-300 ease-out">
                            <div class="bg-white p-2 md:p-3 rounded-[1.5rem] shadow-2xl">
                                <img src="{{ asset('assets/images/activities-2.png') }}" alt="Activity 2"
                                    class="w-full h-32 md:h-40 lg:h-64 object-cover rounded-[1rem]">
                            </div>
                        </div>
                        <!-- Photo 3 -->
                        <div
                            class="transform -rotate-[3deg] hover:rotate-0 hover:scale-105 transition-all duration-300 ease-out mt-2">
                            <div class="bg-white p-2 md:p-3 rounded-[1.5rem] shadow-2xl">
                                <img src="{{ asset('assets/images/activities-3.png') }}" alt="Activity 3"
                                    class="w-full h-32 md:h-40 lg:h-64 object-cover rounded-[1rem]">
                            </div>
                        </div>
                        <!-- Photo 4 -->
                        <div
                            class="transform rotate-[5deg] translate-y-3 lg:translate-y-6 hover:rotate-0 hover:scale-105 transition-all duration-300 ease-out">
                            <div class="bg-white p-2 md:p-3 rounded-[1.5rem] shadow-2xl">
                                <img src="{{ asset('assets/images/activities-4.png') }}" alt="Activity 4"
                                    class="w-full h-32 md:h-40 lg:h-64 object-cover rounded-[1rem]">
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .hide-scrollbar::-webkit-scrollbar {
                        display: none;
                    }

                    .hide-scrollbar {
                        -ms-overflow-style: none;
                        scrollbar-width: none;
                    }
                </style>

                <!-- Mobile version of Photo Collage -->
                <div x-data="{
                    init() {
                        let slider = this.$refs.slider;
                        setInterval(() => {
                            if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 20) {
                                slider.scrollTo({ left: 0, behavior: 'smooth' });
                            } else {
                                slider.scrollBy({ left: 284, behavior: 'smooth' });
                            }
                        }, 3000);
                    }
                }" x-ref="slider"
                    class="flex md:hidden overflow-x-auto gap-6 pb-12 px-6 snap-x snap-mandatory relative z-10 -mx-4 hide-scrollbar pt-6 mb-8">
                    <!-- Photo 1 -->
                    <div class="min-w-[260px] snap-center transform -rotate-3">
                        <div class="bg-white p-3 rounded-[1.25rem] shadow-xl">
                            <img src="{{ asset('assets/images/activities-1.png') }}" alt="Activity 1"
                                class="w-full h-56 object-cover rounded-xl">
                        </div>
                    </div>
                    <!-- Photo 2 -->
                    <div class="min-w-[260px] snap-center transform rotate-2 mt-6">
                        <div class="bg-white p-3 rounded-[1.25rem] shadow-xl">
                            <img src="{{ asset('assets/images/activities-2.png') }}" alt="Activity 2"
                                class="w-full h-56 object-cover rounded-xl">
                        </div>
                    </div>
                    <!-- Photo 3 -->
                    <div class="min-w-[260px] snap-center transform -rotate-2">
                        <div class="bg-white p-3 rounded-[1.25rem] shadow-xl">
                            <img src="{{ asset('assets/images/activities-3.png') }}" alt="Activity 3"
                                class="w-full h-56 object-cover rounded-xl">
                        </div>
                    </div>
                    <!-- Photo 4 -->
                    <div class="min-w-[260px] snap-center transform rotate-3 mt-4">
                        <div class="bg-white p-3 rounded-[1.25rem] shadow-xl">
                            <img src="{{ asset('assets/images/activities-4.png') }}" alt="Activity 4"
                                class="w-full h-56 object-cover rounded-xl">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-16 mt-12 md:mt-24 pb-12">
                    <!-- Day 1 -->
                    <div
                        class="relative bg-gradient-to-b from-[#1D60CB] to-[#0139CC] rounded-[2rem] p-8 pt-12 shadow-2xl border border-white/10 hover:-translate-y-3 transition-transform duration-300 group">
                        <div
                            class="absolute -top-10 left-1/2 transform -translate-x-1/2 bg-gradient-to-br from-highlight to-accent w-20 h-20 rounded-[1.25rem] flex flex-col items-center justify-center shadow-xl shadow-highlight/20 group-hover:-rotate-6 transition-transform duration-500 border-2 border-[#1D60CB] z-10">
                            <span class="font-black font-heading text-primary text-3xl leading-none mt-1">23</span>
                            <span
                                class="font-bold font-sans text-primary text-[10px] uppercase tracking-widest mt-0.5">aug</span>
                        </div>
                        <div class="text-center h-full flex flex-col pt-4">
                            <h3
                                class="font-heading font-black text-white text-4xl mb-4 drop-shadow-md group-hover:scale-110 transition-transform duration-500 uppercase tracking-widest">
                                Day 1</h3>
                            <div
                                class="font-sans font-bold text-accent text-lg leading-relaxed flex-grow flex flex-col items-center justify-center">
                                <span>CAPEU Participant Pick-up</span>
                                <span class="text-sm font-medium mt-1 block">- Soekarno-Hatta Airport</span>
                                <span class="text-sm font-medium block">- Cirebon Railway Station</span>
                            </div>
                        </div>
                    </div>

                    <!-- Day 2 -->
                    <div
                        class="relative bg-gradient-to-b from-[#1D60CB] to-[#0139CC] rounded-[2rem] p-8 pt-12 shadow-2xl border border-white/10 hover:-translate-y-3 transition-transform duration-300 group">
                        <div
                            class="absolute -top-10 left-1/2 transform -translate-x-1/2 bg-gradient-to-br from-highlight to-accent w-20 h-20 rounded-[1.25rem] flex flex-col items-center justify-center shadow-xl shadow-highlight/20 group-hover:-rotate-6 transition-transform duration-500 border-2 border-[#1D60CB] z-10">
                            <span class="font-black font-heading text-primary text-3xl leading-none mt-1">24</span>
                            <span
                                class="font-bold font-sans text-primary text-[10px] uppercase tracking-widest mt-0.5">aug</span>
                        </div>
                        <div class="text-center h-full flex flex-col pt-4">
                            <h3
                                class="font-heading font-black text-white text-4xl mb-4 drop-shadow-md group-hover:scale-110 transition-transform duration-500 uppercase tracking-widest">
                                Day 2</h3>
                            <div
                                class="font-sans font-bold text-accent text-lg leading-relaxed flex-grow flex flex-col items-center justify-center space-y-1">
                                <span>Opening of Activities</span>
                                <span>Campground Exploration Buper Situ Ciranca</span>
                            </div>
                        </div>
                    </div>

                    <!-- Day 3 -->
                    <div
                        class="relative bg-gradient-to-b from-[#1D60CB] to-[#0139CC] rounded-[2rem] p-8 pt-12 shadow-2xl border border-white/10 hover:-translate-y-3 transition-transform duration-300 group">
                        <div
                            class="absolute -top-10 left-1/2 transform -translate-x-1/2 bg-gradient-to-br from-highlight to-accent w-20 h-20 rounded-[1.25rem] flex flex-col items-center justify-center shadow-xl shadow-highlight/20 group-hover:-rotate-6 transition-transform duration-500 border-2 border-[#1D60CB] z-10">
                            <span class="font-black font-heading text-primary text-3xl leading-none mt-1">25</span>
                            <span
                                class="font-bold font-sans text-primary text-[10px] uppercase tracking-widest mt-0.5">aug</span>
                        </div>
                        <div class="text-center h-full flex flex-col pt-4">
                            <h3
                                class="font-heading font-black text-white text-4xl mb-4 drop-shadow-md group-hover:scale-110 transition-transform duration-500 uppercase tracking-widest">
                                Day 3</h3>
                            <div
                                class="font-sans font-bold text-accent text-lg leading-relaxed flex-grow flex flex-col items-center justify-center space-y-1">
                                <span>Agritourism Anggur Brazil</span>
                                <span>Situ Cipanten Exploration</span>
                                <span>Hiking Expedition Bukit Sampora</span>
                            </div>
                        </div>
                    </div>

                    <!-- Day 4 -->
                    <div
                        class="relative bg-gradient-to-b from-[#1D60CB] to-[#0139CC] rounded-[2rem] p-8 pt-12 shadow-2xl border border-white/10 hover:-translate-y-3 transition-transform duration-300 group">
                        <div
                            class="absolute -top-10 left-1/2 transform -translate-x-1/2 bg-gradient-to-br from-highlight to-accent w-20 h-20 rounded-[1.25rem] flex flex-col items-center justify-center shadow-xl shadow-highlight/20 group-hover:-rotate-6 transition-transform duration-500 border-2 border-[#1D60CB] z-10">
                            <span class="font-black font-heading text-primary text-3xl leading-none mt-1">26</span>
                            <span
                                class="font-bold font-sans text-primary text-[10px] uppercase tracking-widest mt-0.5">aug</span>
                        </div>
                        <div class="text-center h-full flex flex-col pt-4">
                            <h3
                                class="font-heading font-black text-white text-4xl mb-4 drop-shadow-md group-hover:scale-110 transition-transform duration-500 uppercase tracking-widest">
                                Day 4</h3>
                            <div
                                class="font-sans font-bold text-accent text-lg leading-relaxed flex-grow flex flex-col items-center justify-center space-y-1">
                                <span>Cikadongdong River Tubing</span>
                                <span>Pasar Bumi Pakuwon Exploration</span>
                            </div>
                        </div>
                    </div>

                    <!-- Day 5 -->
                    <div
                        class="relative bg-gradient-to-b from-[#1D60CB] to-[#0139CC] rounded-[2rem] p-8 pt-12 shadow-2xl border border-white/10 hover:-translate-y-3 transition-transform duration-300 group">
                        <div
                            class="absolute -top-10 left-1/2 transform -translate-x-1/2 bg-gradient-to-br from-highlight to-accent w-20 h-20 rounded-[1.25rem] flex flex-col items-center justify-center shadow-xl shadow-highlight/20 group-hover:-rotate-6 transition-transform duration-500 border-2 border-[#1D60CB] z-10">
                            <span class="font-black font-heading text-primary text-3xl leading-none mt-1">27</span>
                            <span
                                class="font-bold font-sans text-primary text-[10px] uppercase tracking-widest mt-0.5">aug</span>
                        </div>
                        <div class="text-center h-full flex flex-col pt-4">
                            <h3
                                class="font-heading font-black text-white text-4xl mb-4 drop-shadow-md group-hover:scale-110 transition-transform duration-500 uppercase tracking-widest">
                                Day 5</h3>
                            <div
                                class="font-sans font-bold text-accent text-lg leading-relaxed flex-grow flex flex-col items-center justify-center space-y-1">
                                <span>Junior High School 3 Majalengka</span>
                            </div>
                        </div>
                    </div>

                    <!-- Day 6 -->
                    <div
                        class="relative bg-gradient-to-b from-[#1D60CB] to-[#0139CC] rounded-[2rem] p-8 pt-12 shadow-2xl border border-white/10 hover:-translate-y-3 transition-transform duration-300 group">
                        <div
                            class="absolute -top-10 left-1/2 transform -translate-x-1/2 bg-gradient-to-br from-highlight to-accent w-20 h-20 rounded-[1.25rem] flex flex-col items-center justify-center shadow-xl shadow-highlight/20 group-hover:-rotate-6 transition-transform duration-500 border-2 border-[#1D60CB] z-10">
                            <span class="font-black font-heading text-primary text-3xl leading-none mt-1">28</span>
                            <span
                                class="font-bold font-sans text-primary text-[10px] uppercase tracking-widest mt-0.5">aug</span>
                        </div>
                        <div class="text-center h-full flex flex-col pt-4">
                            <h3
                                class="font-heading font-black text-white text-4xl mb-4 drop-shadow-md group-hover:scale-110 transition-transform duration-500 uppercase tracking-widest">
                                Day 6</h3>
                            <div
                                class="font-sans font-bold text-accent text-lg leading-relaxed flex-grow flex flex-col items-center justify-center space-y-1">
                                <span>Closing The Event</span>
                                <span>and Sending Participants Home</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-primary border-t border-white/10 py-8">
        <div
            class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <div class="flex items-center space-x-6">
                <a href="https://www.instagram.com/univmajalengka" target="_blank" rel="noopener noreferrer"
                    class="text-white/80 hover:text-highlight transition font-sans text-sm flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>@univmajalengka</span>
                </a>
            </div>
            <div class="text-white/80 font-sans text-sm">
                &copy; 2026 CAPEU UNMA. All rights reserved.
            </div>
        </div>
    </footer>
</div>
