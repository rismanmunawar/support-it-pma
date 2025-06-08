<!-- resources/views/layouts/app.blade.php (atau base layout utama kamu) -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Deteksi Dark Mode -->
    <script src="/js/darkmode-detector.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styling SweetAlert2 -->
    <link rel="stylesheet" href="/css/sweetalert-custom.css">

    <!-- CSS Transition -->
    <style>
        html {
            transition: background-color 0.3s, color 0.3s;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/turbolinks@5.2.0/dist/turbolinks.js"></script>
    <script>
        Turbolinks.start();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/theme-toggle.js"></script>
    <script src="/js/logout-toast.js"></script>
    @stack('scripts')
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')
    </div>

    @include('components.alert-toast')

</body>

</html>