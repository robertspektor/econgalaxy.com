
@vite(['resources/js/system-map.js'])

<div id="system-map-{{ $systemMapData['system']['id'] }}" class="w-full h-full"></div>

@script
<script>
    // Initialize system map data
    window.mapData = {
        systemMapData: @json($systemMapData),
        playerLocation: @json($playerLocation)
    };

    // Debug: Log the current map data state
    console.log('System Map Data:', window.mapData);

    // Render the System Map with retry logic
    function renderSystemMapWithRetry(attempt = 1, maxAttempts = 20) {
        const systemMapElement = document.getElementById('system-map-{{ $systemMapData['system']['id'] }}');
        if (!systemMapElement) {
            if (attempt < maxAttempts) {
                console.log(`Retrying to find system map element (Attempt ${attempt + 1})...`);
                setTimeout(() => renderSystemMapWithRetry(attempt + 1, maxAttempts), 1000);
            }
            return;
        }

        if (typeof window.renderSystemMap !== 'function') {
            if (attempt < maxAttempts) {
                setTimeout(() => renderSystemMapWithRetry(attempt + 1, maxAttempts), 1000);
            }
            return;
        }

        window.renderSystemMap();
    }

    // Start rendering with retry logic
    renderSystemMapWithRetry();
</script>
@endscript
