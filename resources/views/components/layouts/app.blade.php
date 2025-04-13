<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/boot.css', 'resources/js/app.js', 'resources/js/boot.js', 'resources/js/shutdown.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="bg-gray-50 dark:bg-neutral-900">
    <!-- Page Content -->
    <main id="content">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
