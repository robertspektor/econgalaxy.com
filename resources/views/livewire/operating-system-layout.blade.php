@php
    /**
     * @var array $apps
     * @var bool $isBooting
     */
@endphp

<div class="relative w-full h-screen bg-[#1a1a24] text-white font-mono overflow-hidden">
    <!-- BOOT ANIMATION -->
    <div x-data="{
        showBoot: @json($isBooting),
        bootSteps: [
            '[Checking Hardware Integrity]... [OK]',
            '[Loading Core Modules]... [OK]',
            '[Fusion Reactor Online]... [OK]',
            '[Initializing Nebula OS v2.7.1]... [OK]',
            '[System Ready]... [WELCOME]'
        ],
        currentStep: -1,
        init() {
            if (this.showBoot) {
                this.currentStep = 0;
                this.showNextStep();
            }
        },
        showNextStep() {
            if (this.currentStep < this.bootSteps.length - 1) {
                this.currentStep++;
                setTimeout(() => this.showNextStep(), 1000);
            } else {
                setTimeout(() => {
                    @this.dispatch('boot:complete');
                }, 1000);
            }
        }
    }" x-init="init()" x-show="showBoot" class="absolute inset-0 flex flex-col items-center justify-center bg-black z-50">
        <!-- CRT Effect -->
        <div class="absolute inset-0 opacity-20 pointer-events-none animate-[crt-flicker_2s_infinite]">
            <div class="w-full h-full bg-[repeating-linear-gradient(0deg,transparent,transparent_2px,#ffffff33_2px,#ffffff33_4px)]"></div>
        </div>

        <!-- ASCII Art (Industrial Terminal) -->
        <pre class="text-green-400 text-xs mb-4 animate-[crt-flicker_3s_infinite]">
        ╔════════════════════╗
        ║  NEBULA FORGE OS   ║
        ║  v2.7.1 - Booting  ║
        ╚════════════════════╝
        </pre>

        <!-- Boot Steps -->
        <div class="text-left text-sm">
            <template x-for="(step, index) in bootSteps" :key="index">
                <div x-show="index <= currentStep"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="text-green-400 animate-[crt-flicker_3s_infinite]">
                    <span x-text="step"></span>
                </div>
            </template>
        </div>

        <!-- Blinking Lights -->
        <div class="flex gap-2 mt-4">
            <span class="w-3 h-3 bg-green-400 rounded-full animate-[blink_1s_infinite]"></span>
            <span class="w-3 h-3 bg-yellow-400 rounded-full animate-[blink_1.2s_infinite]"></span>
            <span class="w-3 h-3 bg-red-400 rounded-full animate-[blink_1.5s_infinite]"></span>
        </div>
    </div>

    <!-- SHUTDOWN ANIMATION -->
    <div x-data="{ showShutdown: false }" x-show.transition.duration.1000ms="showShutdown" @shutdown:start.window="showShutdown = true" class="absolute inset-0 flex items-center justify-center bg-black z-50">
        <div class="text-center">
            <div class="text-red-400 text-2xl animate-[crt-shutdown_1s_ease-in-out_forwards]">Power Down...</div>
            <div class="mt-4 text-gray-500 text-sm">[Shutting Down Systems]</div>
        </div>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.effect(() => {
                    if (Alpine.store('showShutdown')) {
                        setTimeout(() => {
                            @this.dispatch('shutdown:complete');
                        }, 1000);
                    }
                });
            });
        </script>
    </div>

    <!-- MAIN DESKTOP (shown after boot, hidden during shutdown) -->
    <div x-show="!@json($isBooting) && !showShutdown" class="relative w-full h-screen">
        <!-- TOPBAR -->
        <div class="fixed top-0 left-0 w-full bg-[#23232f] border-b border-zinc-700 px-4 py-1 flex justify-between items-center z-30 text-xs">
            <div class="flex gap-2">
                <span class="text-cyan-400">kaldir</span>
                <span class="text-gray-300">IP: 87.118.122.254</span>
                <span class="text-magenta-400">[ cmatrix -u 9 -c cyan ]</span>
            </div>
            <div class="flex gap-2">
                <span class="text-gray-300">[ {{ now()->format('D d M H:i') }} ]</span>
                <span class="text-gray-300">up 13:30,</span>
                <span class="text-green-400">↑ 3 KB/s</span>
                <span class="text-red-400">↓ 3 KB/s</span>
                <span class="text-gray-500">wlan: off</span>
                <span class="text-green-400">eth: on</span>
                <span class="text-gray-300">mem: 52%</span>
                <span class="text-gray-300">vol: 30%</span>
            </div>
        </div>

        <!-- DESKTOP ICONS -->
        <div class="absolute top-8 inset-x-0 p-4 grid grid-cols-8 gap-2 pointer-events-none">
            @foreach($apps as $app)
                <div class="flex flex-col items-center gap-1 pointer-events-auto">
                    <button wire:click="openApp('{{ $app['name'] }}')" class="bg-transparent p-2 hover:text-cyan-400">
                        <span class="text-2xl">📦</span>
                    </button>
                    <span class="text-xs text-center text-gray-300">{{ $app['label'] }}</span>
                </div>
            @endforeach
            <div class="flex flex-col items-center gap-1 pointer-events-auto">
                <button class="bg-transparent p-2 hover:text-cyan-400">
                    <span class="text-2xl">📁</span>
                </button>
                <span class="text-xs text-center text-gray-300">Logs</span>
            </div>
            <div class="flex flex-col items-center gap-1 pointer-events-auto">
                <button class="bg-transparent p-2 hover:text-cyan-400">
                    <span class="text-2xl">⚙️</span>
                </button>
                <span class="text-xs text-center text-gray-300">Settings</span>
            </div>
        </div>

        <!-- OPEN WINDOWS -->
        @foreach ($apps as $app)
            @if($app['opened'] && !$app['minimized'])
                @livewire($app['component'], ['id' => $app['name']], key($app['name']))
            @endif
        @endforeach

        <!-- TASKBAR -->
        <div class="fixed bottom-0 left-0 w-full bg-[#23232f] border-t border-zinc-700 px-4 py-1 flex justify-between items-center z-20 text-xs">
            <!-- Left Section: Open Apps -->
            <div class="flex gap-2">
                @foreach($apps as $app)
                    @if($app['opened'])
                        <button wire:click="openApp('{{ $app['name'] }}')"
                                class="{{ $app['minimized'] ? 'text-gray-500' : 'text-cyan-400' }} hover:text-cyan-300 flex items-center gap-1">
                            <span>🖥️</span>
                            <span>{{ $app['label'] }}</span>
                        </button>
                    @endif
                @endforeach
            </div>

            <!-- Right Section: Dummy Status and Notifications -->
            <div class="flex gap-2 items-center">
                <span class="text-gray-300 flex items-center gap-1">
                    <span class="text-yellow-400">💰</span>
                    Credits: 1.250
                </span>
                <span class="text-gray-300 flex items-center gap-1">
                    <span class="text-green-400">⚡</span>
                    Energie: 80%
                </span>
                <button class="text-magenta-400 hover:text-magenta-300 flex items-center gap-1">
                    <span>📩</span>
                    Neue Nachricht: Kael
                </button>
                <button class="text-gray-300 hover:text-cyan-400 flex items-center gap-1">
                    <span>📈</span>
                    Marktpreise aktualisiert
                </button>
                <button class="text-gray-300 hover:text-cyan-400 flex items-center gap-1">
                    <span>🖥️</span>
                    System-Status
                </button>
                <button class="text-gray-300 hover:text-cyan-400 flex items-center gap-1">
                    <span>📜</span>
                    Mitarbeiter-Log
                </button>
                <!-- Shutdown Button -->
                <button @click="$dispatch('shutdown:start')" class="text-red-400 hover:text-red-300 flex items-center gap-1">
                    <span>⏻</span>
                    Ausschalten
                </button>
            </div>
        </div>

        <!-- SYSTEM INFO -->
        <div class="absolute top-2 right-4 text-xs text-gray-500">
            {{ now()->format('Y-m-d H:i:s') }}
        </div>
    </div>
</div>
