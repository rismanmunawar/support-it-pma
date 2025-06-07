<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Deteksi Dark Mode Sebelum Body Tampil -->
    <script>
        if (
            localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

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
    @stack('scripts')
</head>


<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Page Heading -->
        @include('layouts.navigation')
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#16a34a', // Tailwind green-600
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: "{{ session('error') }}",
            confirmButtonColor: '#dc2626', // Tailwind red-600
        });
    </script>
    @endif

    <script>
        document.addEventListener('turbolinks:load', () => {
            const sunIcon = document.getElementById('sun-icon');
            const moonIcon = document.getElementById('moon-icon');

            if (document.documentElement.classList.contains('dark')) {
                moonIcon.style.display = 'block';
                sunIcon.style.display = 'none';
            } else {
                sunIcon.style.display = 'block';
                moonIcon.style.display = 'none';
            }
        });

        function toggleDarkMode() {
            const html = document.documentElement;
            const sunIcon = document.getElementById('sun-icon');
            const moonIcon = document.getElementById('moon-icon');

            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.theme = 'light';
                sunIcon.style.display = 'block';
                moonIcon.style.display = 'none';
            } else {
                html.classList.add('dark');
                localStorage.theme = 'dark';
                sunIcon.style.display = 'none';
                moonIcon.style.display = 'block';
            }
        }
    </script>

</body>

</html>