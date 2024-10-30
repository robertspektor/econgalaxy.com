<div>
    <div id="system-map" class=""></div>
</div>

<script>

    const system = @json($system);

    const sectors = @json($sectors);

    const planets = @json($planets);

    const $moons = @json($moons);

    const $fleets = @json($fleets);

    document.addEventListener('livewire:navigated', function () {
        renderSystemMap(system, sectors, planets, $moons, $fleets);
    });

</script>
