<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    <meta name="description"
        content="{{ $description ?? 'CAPEU 2026 International Mobility Program. Join us for cultural exchange, networking, and outdoor adventures.' }}">
    <meta name="keywords"
        content="{{ $keywords ?? 'CAPEU, International Mobility, Majalengka, UNMA, Cultural Exchange' }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? config('app.name', 'Laravel') }}">
    <meta property="og:description"
        content="{{ $description ?? 'CAPEU 2026 International Mobility Program. Join us for cultural exchange, networking, and outdoor adventures.' }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="{{ $title ?? config('app.name', 'Laravel') }}">
    <meta property="twitter:description"
        content="{{ $description ?? 'CAPEU 2026 International Mobility Program. Join us for cultural exchange, networking, and outdoor adventures.' }}">

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

<body>
    {{ $slot }}
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
