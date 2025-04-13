<div>
    <div id="galaxy-map" class=""></div>
</div>

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
