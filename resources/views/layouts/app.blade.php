<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100%;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>RotationIQ</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="background-image: url('/images/volleyball-court.jpg'); background-size: cover; background-attachment: fixed; background-position: center; background-repeat: no-repeat; margin: 0; padding: 0; display: flex; flex-direction: column; min-height: 100vh;">
        <div style="flex: 1; overflow-y: auto;">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-opacity-80 dark:bg-opacity-80 relative" style="background-color: rgba(255,255,255,0.1); backdrop-filter: blur(10px); z-index: 10;">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Contact Footer -->
        <footer class="mt-auto w-full" style="background-color: rgba(0,0,0,0.3); backdrop-filter: blur(10px); border-top: 1px solid rgba(255,255,255,0.2);">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-white">
                    <!-- Email Section -->
                    <div>
                        <h3 class="font-semibold text-lg mb-2">Email</h3>
                        <p class="text-gray-200">rotationIQ@gmail.com</p>
                    </div>

                    <!-- Phone Section -->
                    <div>
                        <h3 class="font-semibold text-lg mb-2">Phone</h3>
                        <p class="text-gray-200">+371 69-999-999</p>
                    </div>

                </div>

                <!-- Copyright -->
                <div class="mt-6 pt-6 border-t border-gray-400 text-center text-gray-300">
                    <p>&copy; 2026 RotationIQ. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
