<div id="galaxy-map" class="w-full h-full" style="min-height: 600px; background-color: #1a1a24;"></div>

@script
<script>
    window.galaxyMapData = {
        systems: @json($systemsData),
        fleets: @json($fleets),
        initialCenter: @json($initialCenter),
        playerLocation: @json($playerLocation)
    };

    let maxAttempts = 20;
    let attempts = 0;

    function initGalaxyMap() {
        console.log('Initializing galaxy map...');

        if (typeof window.renderGalaxyMap === 'function') {
            window.renderGalaxyMap((systemId) => {
                console.log('System clicked:', systemId);
            });
        } else if (attempts < maxAttempts) {
            attempts++;
            console.log(`Waiting for renderGalaxyMap to be available (attempt ${attempts})...`);
            setTimeout(initGalaxyMap, 100);
        } else {
            console.error('Failed to initialize galaxy map after max attempts');
        }
    }

    document.addEventListener('livewire:navigated', initGalaxyMap);

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGalaxyMap);
    } else {
        initGalaxyMap();
    }
</script>
@endscript
