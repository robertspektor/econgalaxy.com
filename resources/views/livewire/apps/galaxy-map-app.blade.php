<x-window :title="'GALAXY NAVIGATION TERMINAL'" :window-id="$id" :app="$app">
    <div class="flex flex-col h-full text-gray-300 font-mono">
        <!-- Toolbar -->
        <div class="border-b border-zinc-700 bg-[#23232f] p-2 flex gap-2 text-sm">
            <button wire:click="switchToGalaxy"
                    class="{{ $viewMode === 'galaxy' ? 'text-cyan-400' : 'text-gray-400 hover:text-cyan-400 hover:shadow-[0_0_5px_#00FFFF]' }} px-2 py-1 rounded transition-all duration-300">
                Galaxy View
            </button>
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
        <div class="flex-1 p-4 overflow-auto">
            @if($viewMode === 'galaxy')
                <div id="galaxy-map" class="w-full h-full"></div>
            @else
                <div id="system-map" class="w-full h-full"></div>
            @endif
        </div>

        <!-- Hidden button for navigation -->
        <button id="navigate-to-system" wire:click="switchToSystem($event.target.getAttribute('data-system-id'))" style="display: none;"></button>
    </div>

    @script
    <script>
        // Initialize map data if not already set
        window.mapData = window.mapData || {
            systems: [],
            initialCenter: {},
            systemMapData: {},
            playerLocation: {}
        };

        // Update map data with new values, preserving existing data
        window.mapData.systems = @json($systemsData).length > 0 ? @json($systemsData) : window.mapData.systems;
        window.mapData.initialCenter = @json($initialCenter).gridX !== undefined ? @json($initialCenter) : window.mapData.initialCenter;
        window.mapData.systemMapData = @json($systemMapData).system !== undefined ? @json($systemMapData) : window.mapData.systemMapData;
        window.mapData.playerLocation = @json([
            'type' => auth()->user()->location_type,
            'id' => auth()->user()->location_id,
        ]);

        // Debug: Log the current map data state
        console.log('Map Data Updated:', window.mapData);

        // Render the map function with retry logic
        function renderMap(viewMode, attempt = 1, maxAttempts = 10) {
            console.log('Attempting to render map (Attempt ' + attempt + ')... View Mode:', viewMode);
            console.log('Map Data:', window.mapData);

            // Check if the map container exists
            const galaxyMapContainer = document.getElementById('galaxy-map');
            const systemMapContainer = document.getElementById('system-map');
            console.log('Galaxy Map Container:', galaxyMapContainer);
            console.log('System Map Container:', systemMapContainer);

            // If the container isn't found, retry
            if (viewMode === 'galaxy' && !galaxyMapContainer) {
                console.warn('Galaxy Map container not found');
                if (attempt < maxAttempts) {
                    setTimeout(() => renderMap(viewMode, attempt + 1, maxAttempts), 500);
                } else {
                    console.error('Max attempts reached, Galaxy Map container still not found');
                }
                return;
            }

            if (viewMode === 'system' && !systemMapContainer) {
                console.warn('System Map container not found');
                if (attempt < maxAttempts) {
                    setTimeout(() => renderMap(viewMode, attempt + 1, maxAttempts), 500);
                } else {
                    console.error('Max attempts reached, System Map container still not found');
                }
                return;
            }

            // Check if map data is available, retry if not
            if (viewMode === 'galaxy' && (window.mapData.systems.length === 0 || !window.mapData.initialCenter.gridX)) {
                console.warn('Galaxy Map data not yet available');
                if (attempt < maxAttempts) {
                    setTimeout(() => renderMap(viewMode, attempt + 1, maxAttempts), 500);
                } else {
                    console.error('Max attempts reached, Galaxy Map data still not available');
                }
                return;
            }

            if (viewMode === 'system' && (!window.mapData.systemMapData || !window.mapData.systemMapData.system)) {
                console.warn('System Map data not yet available');
                if (attempt < maxAttempts) {
                    setTimeout(() => renderMap(viewMode, attempt + 1, maxAttempts), 500);
                } else {
                    console.error('Max attempts reached, System Map data still not available');
                }
                return;
            }

            // Render the map based on view mode
            if (viewMode === 'galaxy') {
                console.log('Rendering Galaxy Map');
                window.renderGalaxyMap(window.mapData.initialCenter);
            } else if (viewMode === 'system') {
                console.log('Rendering System Map with systemMapData:', window.mapData.systemMapData);
                window.renderSystemMap();
            }
        }

        // Use MutationObserver to watch for the map container
        function watchForMapContainer() {
            const targetNode = document.querySelector('.flex-1.p-4.overflow-auto');
            if (!targetNode) {
                console.warn('Map parent container not found, retrying...');
                setTimeout(watchForMapContainer, 500);
                return;
            }

            const observer = new MutationObserver((mutations, observer) => {
                const galaxyMapContainer = document.getElementById('galaxy-map');
                const systemMapContainer = document.getElementById('system-map');
                const viewMode = @json($viewMode); // Initial view mode for first render
                if (galaxyMapContainer || systemMapContainer) {
                    console.log('Map container found via MutationObserver, rendering...');
                    renderMap(viewMode);
                    observer.disconnect(); // Stop observing once the container is found
                }
            });

            observer.observe(targetNode, { childList: true, subtree: true });
        }

        // Listen for the fallback browser event to navigate to System View
        document.addEventListener('switch-to-system', (event) => {
            console.log('Received switch-to-system event:', event.detail);
            setTimeout(() => {
                console.log('Calling switchToSystem with systemId:', event.detail.systemId);
                @this.call('switchToSystem', event.detail.systemId);
                // Fallback: Simulate click on hidden button
                const navigateButton = document.getElementById('navigate-to-system');
                if (navigateButton) {
                    navigateButton.setAttribute('data-system-id', event.detail.systemId);
                    navigateButton.click();
                } else {
                    console.error('Navigate button not found');
                }
            }, 1000);
        });

        // Render on component load
        document.addEventListener('livewire:load', () => {
            console.log('Livewire:load event fired');
            setTimeout(() => renderMap(@json($viewMode)), 1000);
        });

        // Re-render when the view changes
        document.addEventListener('render-map', (event) => {
            console.log('Render-map event fired with viewMode:', event.detail.viewMode);
            // Add a delay to ensure systemMapData is updated
            setTimeout(() => {
                // Manually update systemMapData to ensure it’s the latest
                window.mapData.systemMapData = @json($systemMapData).system !== undefined ? @json($systemMapData) : window.mapData.systemMapData;
                console.log('Updated systemMapData before rendering:', window.mapData.systemMapData);
                renderMap(event.detail.viewMode);
            }, 1500);
        });

        // Listen for app-opened event from OperatingSystem
        document.addEventListener('app-opened', (event) => {
            if (event.detail.appId === '{{ $id }}') {
                console.log('App-opened event fired for GalaxyMapApp');
                setTimeout(() => renderMap(@json($viewMode)), 1000);
            }
        });

        // Fallback: Render immediately with a delay to ensure DOM readiness
        setTimeout(() => {
            console.log('Fallback render triggered');
            renderMap(@json($viewMode));
        }, 1500);

        // Start watching for the map container
        watchForMapContainer();
    </script>
    @endscript
</x-window>

@vite('resources/js/galaxy-map.js')
