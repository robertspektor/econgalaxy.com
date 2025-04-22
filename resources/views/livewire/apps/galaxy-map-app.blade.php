<x-window :title="'GALAXY NAVIGATION TERMINAL'" :window-id="$id" :app="$app">
    <div class="flex flex-col h-full text-gray-300 font-mono">
        <!-- Toolbar bleibt unverändert -->
        <div class="border-b border-zinc-700 bg-[#23232f] p-2 flex gap-2 text-sm">
            @if($viewMode === 'system' && $selectedSystem)
                <button wire:click="switchToSystem({{ $selectedSystem->id }})"
                        class="text-cyan-400 px-2 py-1 rounded transition-all duration-300">
                    System: {{ $selectedSystem->name }}
                </button>
            @endif
            <div class="flex-1"></div>
            <span class="text-gray-400">
                📍 {{ auth()->user()->location_label }}
            </span>
            <!-- Debug: Force Render Button -->
            <button onclick="renderMap('{{ $viewMode }}')" class="text-gray-400 hover:text-cyan-400 px-2 py-1 rounded">
                Force Render
            </button>
        </div>

        <!-- Map Content -->
        <div class="flex-1 p-4 overflow-hidden">
            <div class="flex w-full h-full gap-4" wire:ignore>
                <!-- Galaxy Map -->
                <div class="w-1/2 h-full bg-[#1a1a24] rounded-lg overflow-hidden border border-zinc-700">
                    <livewire:apps.galaxy-map />
                </div>

                <!-- System Map -->
                <div class="w-1/2 h-full bg-[#1a1a24] rounded-lg overflow-hidden border border-zinc-700">
                    @if($selectedSystem)
                        <livewire:apps.system-map
                            :system-map-data="$systemMapData"
                            :player-location="$playerLocation"
                            wire:key="system-map-{{ $selectedSystem->id }}"
                        />
                    @else
                        <div class="flex items-center justify-center h-full text-gray-500">
                            Select a system to view details
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-window>
