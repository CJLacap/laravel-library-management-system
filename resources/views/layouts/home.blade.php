<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Library Management & Reservation System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased ">
        <div class="min-h-screen  bg-gray-100 dark:bg-gray-900">
            @include('layouts.home-nav')
            
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
              <!-- Footer Section -->
              <footer class="bg-transparent text-white p-4 text-center">
                <p>&copy; 2023 LM<span class="text-sky-500">&</span>RS. All rights reserved.</p>
            </footer>
        </div>
    </body>
</html>
