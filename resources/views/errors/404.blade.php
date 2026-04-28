<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Vidly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}?v={{ time() }}">


</head>
<body class="bg-aurora-dark antialiased">
<div class="min-h-screen flex flex-col items-center justify-center text-center px-4">

    {{-- Logo V com brilho --}}
    <x-application-logo class="w-32 h-32 text-aurora-vibrant mb-8" />

    <h1 class="text-7xl font-black text-white tracking-tighter">
        ERROR <span class="text-aurora-vibrant">404</span>
    </h1>

    <p class="text-xl font-bold text-white/80 mt-4 italic">
        "It seems that this scene was cut during editing..."
    </p>

    <p class="text-white/40 mt-2 max-w-md">
        The page are you searching for does not exist or changed seasons.
    </p>

    <div class="mt-10">
        <a href="{{ route('Home') }}"
           class="px-8 py-4 bg-aurora-vibrant hover:bg-aurora-deep text-white font-black uppercase text-sm tracking-widest rounded-2xl transition-all shadow-[0_0_30px_rgba(139,50,244,0.4)] hover:scale-105 transform">
            Back to login
        </a>
    </div>

</div>
</body>
</html>
