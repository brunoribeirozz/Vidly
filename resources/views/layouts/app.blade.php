<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vidly') }}</title>

    <!-- Favicons Organizados -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts e CSS -->
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

    <!-- Flash Messages (Extraído para lógica mais limpa) -->
    @if (session('message.success'))
        <div id="flash-message" class="max-w-7xl mx-auto px-4 mt-6 transition-opacity duration-500">
            <div class="bg-aurora-vibrant/20 border border-aurora-vibrant/50 text-aurora-deep px-6 py-4 rounded-xl shadow-[0_0_20px_rgba(139,50,244,0.3)] flex justify-between items-center">
                <span class="font-bold">{{ session('message.success') }}</span>
                <button onclick="closeMessage()" class="text-aurora-deep/50 hover:text-aurora-deep transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <main>
        {{ $slot }}
    </main>
</div>

<!-- Scripts de final de página -->
<script>
    function closeMessage() {
        const msg = document.getElementById('flash-message');
        if (msg) {
            msg.style.opacity = '0';
            setTimeout(() => msg.remove(), 500);
        }
    }

    // Auto-close após 4s se a mensagem existir
    if (document.getElementById('flash-message')) {
        setTimeout(closeMessage, 4000);
    }
</script>
</body>
</html>
