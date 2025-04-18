<div class="bg-black text-white h-screen">
    <div id="galaxy-map" class=""></div>
</div>

@vite('resources/js/galaxymap.js')

<script>



    const systems = @json($systems);

    const fleets = @json($fleets);

    const spaceports = @json($spaceports);

    const positions = @json([
        'gridX' => 1000,
        'gridY' => 1000,
    ]);

    document.addEventListener('livewire:navigated', function () {
        renderGalaxyMap(positions);
        // renderSchematicGalaxyMap(systems, fleets, spaceports);
        // renderDynamicGalaxyMap(positions);
    });

</script>
