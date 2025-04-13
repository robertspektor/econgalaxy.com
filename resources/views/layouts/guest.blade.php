<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Nebula Forge') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=ibm-plex-mono:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/boot.css', 'resources/js/app.js', 'resources/js/boot.js', 'resources/js/shutdown.js'])
    @livewireStyles
</head>
<body class="bg-[#1a1a24] text-white font-mono antialiased">
<div class="relative min-h-screen flex flex-col items-center justify-center">
    <!-- Subtle CRT Background Effect -->
    <div class="absolute inset-0 opacity-10 pointer-events-none animate-crt-flicker">
        <div class="w-full h-full bg-[repeating-linear-gradient(0deg,transparent,transparent_2px,#ffffff33_2px,#ffffff33_4px)]"></div>
    </div>

    <!-- ASCII Art Header -->
    <div class="mb-6 text-center">
            <pre class="text-cyan-400 text-sm animate-crt-flicker">
╔════════════════════╗
║  NEBULA FORGE OS   ║
║  v2.7.1 - Access   ║
╚════════════════════╝
            </pre>
    </div>

    <!-- Content Slot -->
    <div class="w-full sm:max-w-md px-6 py-4">
        {{ $slot }}
    </div>
</div>
@livewireScripts
</body>
</html>
