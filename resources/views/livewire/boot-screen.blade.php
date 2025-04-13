@php
    /**
     * @var bool $isBooting
     */
@endphp

<div class="relative w-full h-screen bg-[#1a1a24] text-white font-mono overflow-hidden">
    <div x-data="bootScreen" x-show="showBoot" class="absolute inset-0 flex flex-col items-center justify-center bg-black z-50">
        <!-- CRT Effect -->
        <div class="absolute inset-0 opacity-20 pointer-events-none animate-crt-flicker">
            <div class="w-full h-full bg-[repeating-linear-gradient(0deg,transparent,transparent_2px,#ffffff33_2px,#ffffff33_4px)]"></div>
        </div>

        <!-- ASCII Art (Industrial Terminal) -->
        <pre class="text-green-400 text-xs mb-4 animate-crt-flicker">
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
                     class="text-green-400 animate-crt-flicker">
                    <span x-text="step"></span>
                </div>
            </template>
        </div>

        <!-- Blinking Lights -->
        <div class="flex gap-2 mt-4">
            <span class="w-3 h-3 bg-green-400 rounded-full animate-blink"></span>
            <span class="w-3 h-3 bg-yellow-400 rounded-full animate-[blink_1.2s_infinite]"></span>
            <span class="w-3 h-3 bg-red-400 rounded-full animate-[blink_1.5s_infinite]"></span>
        </div>
    </div>
</div>
