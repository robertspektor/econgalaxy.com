<div class="absolute bottom-16 right-4 z-20 text-gray-300 font-mono text-xs bg-[#23232f] border border-zinc-700 rounded shadow-xl p-4 w-64"
     x-data="{ isCollapsed: false }"
     @location-changed.window="$el.classList.add('animate-crt-flicker')"
>
    <!-- Toggle Collapse -->
    <div class="flex justify-between items-center mb-2">
        <span class="text-cyan-400">LOCATION STATUS</span>
        <button @click="isCollapsed = !isCollapsed" class="text-gray-400 hover:text-cyan-400">
            <span x-show="!isCollapsed">▼</span>
            <span x-show="isCollapsed">▲</span>
        </button>
    </div>

    <!-- Widget Content -->
    <div x-show="!isCollapsed" x-transition.opacity>
        <!-- Location Name and Visualization -->
        <div class="mb-2">
            <pre class="text-gray-400">
┌──────────────────────────────┐
│ {{ auth()->user()->location_type === 'system' ? '🌌' : (auth()->user()->location_type === 'planet' ? '🪐' : '🌕') }} {{ auth()->user()->location_label }} │
└──────────────────────────────┘
            </pre>
        </div>

        <!-- Placeholder Image for Location -->
        <div class="relative mb-2">
            <!-- Placeholder Image -->
            <div class="w-full h-32 bg-[#1a1a24] rounded overflow-hidden relative">

                <div class="absolute inset-0 bg-[url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAIAAAAyCAYAAACRE1J6AAAAAXNSR0IArs4c6QAAABJJREFUCB1jZGBg+M/AwMDI4AAAtfYDKr5FByYAAAAASUVORK5CYII=')] opacity-20 animate-crt-flicker"></div>
                <!-- Placeholder Image (can be replaced dynamically later) -->
                <img src="{{ asset('images/origins/federation_core_worlder.jpeg') }}"
                     alt="Location Image"
                     class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Environmental Conditions (Simulated Weather) -->
        <div class="mb-2">
            <span class="text-gray-400">ENVIRONMENTAL CONDITIONS</span>
            <div class="text-gray-500 text-xs">
                <p>Temperature: {{ rand(-50, 50) }}°C</p>
                <p>Radiation: {{ rand(0, 100) }} µSv/h</p>
                @if(auth()->user()->location_type === 'planet' || auth()->user()->location_type === 'moon')
                    <p>Atmosphere: {{ ['None', 'Thin Oxygen', 'Toxic'][rand(0, 2)] }}</p>
                @endif
            </div>
        </div>

        <!-- Metadata -->
        <div class="mb-2">
            <span class="text-gray-400">METADATA</span>
            <div class="text-gray-500 text-xs">
                <p>Population: {{ number_format(rand(0, 1000000)) }}</p>
                <p>Resources: {{ ['Metals', 'Crystals', 'Gases'][rand(0, 2)] }}</p>
                <p>Economic Activity: {{ ['Mining', 'Trade Hub', 'Research'][rand(0, 2)] }}</p>
            </div>
        </div>

        <!-- Faction Information -->
        <div class="mb-2">
            <span class="text-gray-400">FACTION CONTROL</span>
            <div class="text-gray-500 text-xs">
                <p>Faction: {{ ['Galactic Federation', 'Rebel Alliance', 'None'][rand(0, 2)] }}</p>
                <p>Political Status: {{ ['Stable', 'Unstable', 'Conflict'][rand(0, 2)] }}</p>
                <p>Reputation: {{ rand(0, 100) }}%</p>
            </div>
        </div>
    </div>
</div>
