<x-window :title="'StellarBrowser'" :window-id="'stellarBrowser'" :app="$app">
    <div class="flex flex-col h-full">
        <!-- Browser Toolbar -->
        <div class="flex items-center gap-2 p-2 border-b border-zinc-700 bg-[#23232f]">
            <input type="text" wire:model="url" class="flex-1 bg-[#1a1a24] text-gray-300 border-zinc-700 p-1 rounded focus:ring-cyan-400 focus:border-cyan-400" readonly>
            <button wire:click="loadPage('galactic-federation-portal')" class="text-gray-400 hover:text-cyan-400">↻</button>
        </div>

        <!-- Web Content -->
        <div class="flex-1 p-4 overflow-auto">
            @if($url && array_key_exists($url, $webpages))
                @livewire($webpages[$url], key($url))
            @else
                <div class="text-gray-500 text-sm">Page not found.</div>
            @endif
        </div>
    </div>
</x-window>
