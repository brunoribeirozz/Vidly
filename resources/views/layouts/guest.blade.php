<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Remova as linhas antigas de favicon.png e coloque esta -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v={{ time() }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">




        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-aurora-deep">
        <div>
                <a href="/">
                    {{-- h-24 e w-24 deixam a logo bem grande. O shadow cria o efeito neon --}}
                    <x-application-logo class="w-24 h-24 text-white drop-shadow-[0_0_25px_rgba(139,50,244,1)]" />


                </a>
            </div>

        {{-- BG White com um brilho Roxo Ultra Forte --}}
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white
            shadow-[0_0_60px_10px_rgba(139,50,244,0.8)]
            border-2 border-aurora-vibrant/30
            overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>



    </div>
    </body>
</html>
