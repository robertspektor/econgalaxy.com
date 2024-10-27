<div>
    <div id="graph-container" class="bg-white rounded-xl shadow-sm dark:bg-neutral-900 overflow-hidden"></div>
</div>

<script>

    const sectors = @json($sectors);

    const jumpGates = @json($jumpGates);

    document.addEventListener('livewire:navigated', function () {
        renderMap(sectors, jumpGates);
    });

</script>
