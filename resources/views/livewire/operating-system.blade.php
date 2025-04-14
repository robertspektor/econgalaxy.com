@php
    /**
     * @var array $apps
     */
@endphp

<div class="relative w-full h-screen bg-[#1a1a24] text-white font-mono overflow-hidden">
    <!-- SHUTDOWN ANIMATION -->
    <div x-data="shutdownScreen" @shutdown:start.window="showShutdown = true" x-show.transition.duration.1000ms="typeof showShutdown !== 'undefined' ? showShutdown : false" class="absolute inset-0 flex items-center justify-center bg-black z-50">
        <div class="text-center">
            <div class="text-red-400 text-2xl animate-crt-shutdown">Power Down...</div>
            <div class="mt-4 text-gray-500 text-sm">[Shutting Down Systems]</div>
        </div>
    </div>

    <!-- MAIN DESKTOP -->
    <div x-show="typeof showShutdown !== 'undefined' ? !showShutdown : true" class="relative w-full h-screen">
        <!-- TOPBAR -->
        <div class="fixed top-0 left-0 w-full bg-[#23232f] border-b border-zinc-700 px-4 py-1 flex justify-between items-center z-30 text-xs">
            <div class="flex gap-2">
                <span class="text-cyan-400">kaldir</span>
                <span class="text-gray-300">IP: 87.118.122.254</span>
                <span class="text-magenta-400">[ cmatrix -u 9 -c cyan ]</span>
            </div>
            <div class="flex gap-2">
                <span class="text-gray-300">[ {{ now()->format('D d M H:i') }} ]</span>
                <span class="text-gray-300">up 13:30,</span>
                <span class="text-green-400">↑ 3 KB/s</span>
                <span class="text-red-400">↓ 3 KB/s</span>
                <span class="text-gray-500">wlan: off</span>
                <span class="text-green-400">eth: on</span>
                <span class="text-gray-300">mem: 52%</span>
                <span class="text-gray-300">vol: 30%</span>
            </div>
        </div>

        <!-- DESKTOP ICONS -->
        <div class="absolute top-8 inset-x-0 p-4 grid grid-cols-8 gap-2 pointer-events-none">
            @foreach($apps as $app)
                <div class="flex flex-col items-center gap-1 pointer-events-auto">
                    <button wire:click="openApp('{{ $app['name'] }}')" class="bg-transparent p-2 hover:text-cyan-400">
                        <span class="text-2xl">📦</span>
                    </button>
                    <span class="text-xs text-center text-gray-300">{{ $app['label'] }}</span>
                </div>
            @endforeach
            <div class="flex flex-col items-center gap-1 pointer-events-auto">
                <button class="bg-transparent p-2 hover:text-cyan-400">
                    <span class="text-2xl">📁</span>
                </button>
                <span class="text-xs text-center text-gray-300">Logs</span>
            </div>
            <div class="flex flex-col items-center gap-1 pointer-events-auto">
                <button class="bg-transparent p-2 hover:text-cyan-400">
                    <span class="text-2xl">⚙️</span>
                </button>
                <span class="text-xs text-center text-gray-300">Settings</span>
            </div>
        </div>

        <!-- OPEN WINDOWS -->
        @foreach ($apps as $app)
            @if($app['opened'] && !$app['minimized'])
                @livewire($app['component'], ['id' => $app['name'], 'app' => $app], key($app['name']))
            @endif
        @endforeach

        <!-- TASKBAR -->
        <div class="fixed bottom-0 left-0 w-full bg-[#23232f] border-b border-zinc-700 px-4 py-1 flex justify-between items-center z-20 text-xs">
            <!-- Left Section: Open Apps -->
            <div class="flex gap-2">
                @foreach($apps as $app)
                    @if($app['opened'])
                        <button wire:click="openApp('{{ $app['name'] }}')"
                                class="{{ $app['minimized'] ? 'text-gray-500' : 'text-cyan-400' }} hover:text-cyan-300 flex items-center gap-1">
                            <span>🖥️</span>
                            <span>{{ $app['label'] }}</span>
                        </button>
                    @endif
                @endforeach
            </div>

            <!-- Right Section: System Tray -->
            <div class="flex gap-2 items-center"
                 x-data="{ location: '{{ $currentLocationLabel }}' }"
                 @location-changed.window="location = '{{ $currentLocationLabel }}'; $el.classList.add('animate-crt-flicker')"
            >
                <!-- Location Indicator -->
                <span title="Current Location: {{ $currentLocationLabel }}"
                      class="text-gray-300 hover:text-cyan-400 flex items-center gap-1">
                    📍
                </span>

                <span class="text-gray-300 flex items-center gap-1">
                    <span class="text-yellow-400">💰</span>
                    Credits: 1.250
                </span>
                <span class="text-gray-300 flex items-center gap-1">
                    <span class="text-green-400">⚡</span>
                    Energie: 80%
                </span>
                <button class="text-magenta-400 hover:text-magenta-300 flex items-center gap-1">
                    <span>📩</span>
                    Neue Nachricht: Kael
                </button>
                <button class="text-gray-300 hover:text-cyan-400 flex items-center gap-1">
                    <span>📈</span>
                    Marktpreise aktualisiert
                </button>
                <button class="text-gray-300 hover:text-cyan-400 flex items-center gap-1">
                    <span>🖥️</span>
                    System-Status
                </button>
                <button class="text-gray-300 hover:text-cyan-400 flex items-center gap-1">
                    <span>📜</span>
                    Mitarbeiter-Log
                </button>
                <!-- Shutdown Button -->
                <button @click="$dispatch('shutdown:start')" class="text-red-400 hover:text-red-300 flex items-center gap-1">
                    <span>⏻</span>
                    Ausschalten
                </button>
            </div>
        </div>

        <!-- SYSTEM INFO -->
        <div class="absolute top-2 right-4 text-xs text-gray-500"
             x-data="{ location: '{{ $currentLocationLabel }}' }"
             @location-changed.window="location = '{{ $currentLocationLabel }}'; $el.classList.add('animate-crt-flicker')"
        >
            {{ now()->format('Y-m-d H:i:s') }}
            <br>
            <span class="text-gray-400">📍 <span x-text="location">{{ $currentLocationLabel }}</span></span>
            @php
                $travel = auth()->user()->travels()->where('arrives_at', '>', now())->first();
            @endphp
            @if($travel)
                <br>
                <span class="text-gray-400">In Transit: Arriving at
                    @if($travel->destination_type === 'system')
                        🌌 System: {{ $travel->destination->name }}
                    @elseif($travel->destination_type === 'planet')
                        Planet: {{ $travel->destination->name }} ({{ $travel->destination->system->name }})
                    @elseif($travel->destination_type === 'moon')
                        Moon: {{ $travel->destination->name }} ({{ $travel->destination->planet->name }})
                    @endif
                    on {{ $travel->arrives_at->format('Y-m-d H:i:s') }}
                </span>
            @endif
        </div>

        <!-- Location Widget (Bottom-Right Corner) -->
        <x-location-widget />
    </div>
</div>
