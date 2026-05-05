<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-primary via-secondary to-primary relative overflow-hidden">
    <!-- Sporty decorative shapes -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 opacity-20 pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-accent rounded-full blur-3xl mix-blend-multiply"></div>
        <div class="absolute top-1/2 -left-24 w-72 h-72 bg-highlight rounded-full blur-3xl mix-blend-multiply"></div>
    </div>

    <div class="z-10 relative">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-2xl z-10 relative border border-gray-100">
        {{ $slot }}
    </div>
</div>
