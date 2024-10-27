<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">

        <div class="w-full overflow-hidden">

            <livewire:maps.sector-map />
        </div>
    </div>
</x-app-layout>
