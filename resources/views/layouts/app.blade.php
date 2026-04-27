<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vidly') }}</title>

    <!-- Fonts -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v={{ time() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">



    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body class="font-sans antialiased bg-aurora-light text-black">
<div class="min-h-screen">
    @include('layouts.navigation')


    @isset($header)

        <header class="bg-gray-200 border-b border-white/5">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    @if (session('message.success'))
        <div id="welcome-message" class="max-w-7xl mx-auto px-4 mt-6 transition-opacity duration-500">
            <div class="bg-aurora-vibrant/20 border border-aurora-vibrant/50 text-aurora-deep px-6 py-4 rounded-xl shadow-[0_0_20px_rgba(139,50,244,0.3)] flex justify-between items-center">
                <span class="font-bold">{{ session('message.success') }}</span>
                <button onclick="document.getElementById('welcome-message').remove()" class="text-aurora-light/50 hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Script nativo que funciona independente de Alpine ou Vite --}}
        <script>
            setTimeout(function() {
                const msg = document.getElementById('welcome-message');
                if (msg) {
                    msg.style.opacity = '0';
                    setTimeout(() => msg.remove(), 500); // Remove do HTML após o fade
                }
            }, 4000); // 4 segundos
        </script>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>

</body>
</html>
