<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @fluxStyles
    </head>
    <body class="bg-gray-50 dark:bg-neutral-900">
        <livewire:top-navigation />

        <div class="min-h-screen bg-gray-100 dark:bg-neutral-900  pt-10">

            <livewire:start-game-helper />

            <livewire:layout.navigation />

            <!-- Page Heading -->
{{--            @if (isset($header))--}}
{{--                <header class="bg-white dark:bg-gray-800 shadow">--}}
{{--                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                        {{ $header }}--}}
{{--                    </div>--}}
{{--                </header>--}}
{{--            @endif--}}

            <!-- Page Content -->
            <main id="content" class="lg:ps-[64px] pt-[59px] lg:pt-0">
                {{ $slot }}
            </main>
        </div>

        <flux:toast />

        @fluxScripts

    </body>
</html>
