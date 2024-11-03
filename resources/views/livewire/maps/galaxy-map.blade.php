<div>
    <div id="galaxy-map" class=""></div>
</div>

<script>

    const systems = @json($systems);

    const fleets = @json($fleets);

    const spaceports = @json($spaceports);

    document.addEventListener('livewire:navigated', function () {
        renderGalaxyMap(systems, fleets, spaceports);
    });

</script>
