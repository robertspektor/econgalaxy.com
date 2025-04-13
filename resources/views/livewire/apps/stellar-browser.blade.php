<x-window :title="'INTRA-NET ACCESS TERMINAL v3.2.1'" :window-id="'stellarBrowser'" :app="$app">
    <div class="flex flex-col h-full text-gray-300 font-mono">
        <!-- Browser Toolbar -->
        <div class="border-b border-zinc-700 bg-[#23232f] p-2">
            <div class="flex items-center gap-2 mb-2">
                <input type="text" wire:model.debounce.500ms="query" @keydown.enter="search"
                       class="flex-1 bg-[#1a1a24] text-gray-300 border-zinc-700 p-1 rounded focus:ring-cyan-400 focus:border-cyan-400 placeholder-gray-500"
                       placeholder="/search?query=">
                <button wire:click="search" class="text-gray-400 hover:text-cyan-400">↻</button>
            </div>
            <div class="flex gap-2 text-sm">
                <button wire:click="loadPage('home')"
                        class="{{ $currentPage === 'home' ? 'text-cyan-400' : 'text-gray-400 hover:text-cyan-400' }}">
                    ▸ Home
                </button>
                <button wire:click="loadPage('factions')"
                        class="{{ $currentPage === 'factions' ? 'text-cyan-400' : 'text-gray-400 hover:text-cyan-400' }}">
                    ▸ Fraktionen
                </button>
                <button wire:click="loadPage('companies')"
                        class="{{ $currentPage === 'companies' ? 'text-cyan-400' : 'text-gray-400 hover:text-cyan-400' }}">
                    ▸ Firmen
                </button>
                <button wire:click="loadPage('forms')"
                        class="{{ $currentPage === 'forms' ? 'text-cyan-400' : 'text-gray-400 hover:text-cyan-400' }}">
                    ▸ Formulare
                </button>
                <button wire:click="loadPage('news')"
                        class="{{ $currentPage === 'news' ? 'text-cyan-400' : 'text-gray-400 hover:text-cyan-400' }}">
                    ▸ Nachrichten
                </button>
            </div>
        </div>

        <!-- Web Content -->
        <div class="flex-1 p-4 overflow-auto bg-[#2d2d3f]"
             x-data="{
                 isLoading: {{ $isLoadingContent ? 'true' : 'false' }},
                 progress: 0,
                 currentMessageIndex: 0,
                 messages: [
                     'Verbindungsaufbau ...',
                     'Abruf der Daten ...',
                     'Authentifizierung ...',
                     'Datenpaket wird entschlüsselt ...',
                     'Überprüfung der Integrität ...',
                     'Verbindung stabilisiert ...'
                 ],
                 latency: {{ $latency }},

                 init() {
                     console.log('Initializing StellarBrowser content area, isLoading:', this.isLoading);
                     if (this.isLoading) {
                         this.startLoading();
                     }
                 },
                 startLoading() {
                     this.isLoading = true;
                     this.progress = 0;
                     this.currentMessageIndex = 0;
                     const steps = 20;
                     const interval = this.latency / steps;
                     let step = 0;

                     const loadingInterval = setInterval(() => {
                         step++;
                         this.progress = (step / steps) * 100;
                         this.currentMessageIndex = (step % this.messages.length);

                         console.log('Loading step:', step, 'Progress:', this.progress, 'Message:', this.messages[this.currentMessageIndex]);

                         if (step >= steps) {
                             clearInterval(loadingInterval);
                             this.isLoading = false;
                             console.log('Loading complete');
                         }
                     }, interval);
                 }
             }"
             @content-loading.window="startLoading()"
        >
            <div class="border border-zinc-700 rounded p-4">
                <pre class="text-cyan-400 text-sm mb-2">
┌───────────────────────────────────────────────┐
│ > Willkommen im föderalen Informationsnetzwerk│
│ > Zugriff bereitgestellt: ID {{ auth()->id() }} │
└───────────────────────────────────────────────┘
                </pre>

                <div x-show="isLoading" class="text-gray-300 text-sm">
                    <div class="mb-2 animate-crt-flicker" x-text="messages[currentMessageIndex]"></div>
                    <div class="h-1 w-full bg-[#1a1a24] rounded overflow-hidden">
                        <div class="h-full bg-cyan-400 transition-all duration-100"
                             :style="`width: ${progress}%`"></div>
                    </div>
                    <div class="mt-2 text-gray-500 text-xs animate-crt-flicker">
                        [<span x-text="Math.round(progress)">0</span>%] ███████████
                    </div>
                </div>

                <div x-show="!isLoading">
                    @if($currentPage && array_key_exists($currentPage, $webpages))
                        @livewire($webpages[$currentPage], $pageParams, key($currentPage . '-' . json_encode($pageParams)))
                    @else
                        <div class="text-gray-500 text-sm">Page not found.</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Console Log -->
        <div class="border-t border-zinc-700 bg-[#23232f] p-2 text-xs text-gray-500">
            <div class="max-h-20 overflow-auto">
                @foreach($consoleLog as $log)
                    <div>[{{ $log['timestamp'] }}] {{ $log['message'] }}</div>
                @endforeach
            </div>
        </div>
    </div>
</x-window>
