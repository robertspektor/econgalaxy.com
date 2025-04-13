<div class="text-gray-300">
    <div class="text-sm mb-4">
        Fraktionen im föderalen Netzwerk:
    </div>
    <div class="space-y-2">
        <div>
            <a href="javascript:void(0)" wire:click="$parent.loadPage('faction', { id: 1 })"
               class="text-cyan-400 hover:text-cyan-300 underline">
                Galactic Federation
            </a>
            <p class="text-gray-500 text-xs">Die zentrale Autorität des Universums.</p>
        </div>
        <div>
            <a href="javascript:void(0)" wire:click="$parent.loadPage('faction', { id: 2 })"
               class="text-cyan-400 hover:text-cyan-300 underline">
                Rebel Alliance
            </a>
            <p class="text-gray-500 text-xs">Kämpfer für die Freiheit und Unabhängigkeit.</p>
        </div>
    </div>
</div>
