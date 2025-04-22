@vite(['resources/js/galaxy-map.js'])

<div id="galaxy-map" class="w-full h-full"></div>

@script
<script>
    // Initialize galaxy map data
    window.mapData = {
        systems: @json($systemsData),
        initialCenter: @json($initialCenter),
        playerLocation: @json($playerLocation),
        fleets: @json($fleets)
    };

    // Debug: Log the current map data state
    console.log('Galaxy Map Data:', window.mapData);

    // Render the Galaxy Map with retry logic
    function renderGalaxyMapWithRetry(attempt = 1, maxAttempts = 20) {
        const galaxyMapElement = document.getElementById('galaxy-map');
        if (!galaxyMapElement) {
            if (attempt < maxAttempts) {
                console.log(`Retrying to find galaxy map element (Attempt ${attempt + 1})...`);
                setTimeout(() => renderGalaxyMapWithRetry(attempt + 1, maxAttempts), 1000);
            }
            return;
        }

        if (typeof window.renderGalaxyMap !== 'function') {
            if (attempt < maxAttempts) {
                setTimeout(() => renderGalaxyMapWithRetry(attempt + 1, maxAttempts), 1000);
            }
            return;
        }

        window.renderGalaxyMap(window.mapData, galaxyMapElement);
    }

    // Start rendering with retry logic
    renderGalaxyMapWithRetry();

    // Event-Listener für System-Updates
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('systemSelected', (data) => {
            // Optional: Hier können wir zusätzliche Client-seitige Aktionen ausführen
            console.log('System selected:', data);
        });
    });

</script>
@endscript
