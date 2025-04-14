<x-window :title="'GALACTIC COMMUNICATION UPLINK'" :window-id="$id" :app="$app">
    <div class="flex h-full text-gray-300 font-mono">
        <!-- Sidebar: Folders -->
        <div class="w-1/4 border-r border-zinc-700 bg-[#1a1a24] p-2">
            <div class="text-sm mb-2 text-gray-400">Signalkanäle</div>
            <ul class="space-y-1">
                @foreach(['inbox' => 'Inbox', 'sent' => 'Gesendet', 'archive' => 'Archiv', 'system' => 'Systemmeldungen', 'faction' => 'Fraktionsnachrichten'] as $folder => $label)
                    <li wire:click="selectFolder('{{ $folder }}')"
                        class="p-2 cursor-pointer {{ $currentFolder === $folder ? 'bg-[#2d2d3f] text-cyan-400' : 'text-gray-400 hover:bg-[#2d2d3f] hover:text-cyan-400' }}">
                        {{ $label }}
                    </li>
                @endforeach
            </ul>
            <button wire:click="startComposing"
                    class="mt-2 w-full text-left p-2 bg-cyan-400 text-black rounded hover:bg-cyan-300 transition-all duration-300 text-sm">
                [✍ Nachricht schreiben]
            </button>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Message List -->
            @if(!$isComposing)
                <div class="flex-1 p-2 overflow-auto">
                    <ul class="space-y-1">
                        @foreach($messages as $message)
                            <li wire:click="selectMessage({{ $message->id }})"
                                class="p-2 cursor-pointer hover:bg-[#2d2d3f] {{ $selectedMessage && $selectedMessage->id === $message->id ? 'bg-[#2d2d3f]' : '' }}">
                                <div class="text-sm font-medium {{ $message->is_read ? 'text-gray-400' : 'font-bold text-white' }} {{ $message->priority === 'critical' ? 'text-red-400' : ($message->priority === 'high' ? 'text-yellow-400' : 'text-green-400') }}">
                                    {{ $message->from }}
                                    @if(!$message->is_read)
                                        <span class="ml-2 text-green-400">●</span>
                                    @endif
                                </div>
                                <div class="text-xs">{{ $message->subject }}</div>
                                <div class="text-xs text-gray-500">{{ $message->received_at->format('Y.m.d H:i') }}</div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Message View -->
                <div class="flex-1 p-4 overflow-auto border-t border-zinc-700">
                    @if($selectedMessage)
                        <div class="text-gray-300 text-sm">
                            <pre class="text-gray-400 mb-2">
┌──────────────────────────────────────────────────────┐
│    GALACTIC COMMUNICATION UPLINK — TRANSMISSION LOG │
├──────────────────────────────────────────────────────┤
│ FROM:   {{ $selectedMessage->from }}                 │
│ TO:     {{ $selectedMessage->to ?? auth()->user()->name }} │
│ CHANNEL: {{ $selectedMessage->channel ?? 'Standard' }} │
│ TIME:   {{ $selectedMessage->received_at->format('Y.m.d – H:i UTC') }} │
│ STATUS: {{ $selectedMessage->is_read ? 'READ' : 'UNREAD' }} · PRIORITY: {{ strtoupper($selectedMessage->priority) }} │
├──────────────────────────────────────────────────────┤
                            </pre>
                            <div class="whitespace-pre-wrap">{{ $selectedMessage->body }}</div>
                            @if(str_contains($selectedMessage->body, '/docs/core/license'))
                                <div class="mt-2">
                                    <a href="javascript:void(0)" wire:click="openBrowserLink('/docs/core/license')"
                                       class="text-cyan-400 hover:text-cyan-300 underline">
                                        Antrag einsehen
                                    </a>
                                </div>
                            @endif
                            <pre class="text-gray-400 mt-2">
└──────────────────────────────────────────────────────┘
                            </pre>
                        </div>
                    @else
                        <div class="text-gray-500 text-sm">Wählen Sie eine Nachricht aus, um sie anzuzeigen.</div>
                    @endif
                </div>
            @else
                <!-- Compose Message -->
                <div class="flex-1 p-4 overflow-auto">
                    <div class="text-gray-300 text-sm">
                        <pre class="text-gray-400 mb-2">
┌──────────────────────────────────────────────────────┐
│    NEW TRANSMISSION — GALACTIC COMMUNICATION UPLINK │
├──────────────────────────────────────────────────────┤
                        </pre>
                        <form wire:submit="sendMessage">
                            <div class="space-y-4">
                                <!-- Recipient -->
                                <div>
                                    <label class="block text-gray-400 text-sm">Empfänger</label>
                                    <input type="text" wire:model="recipient"
                                           class="w-full bg-[#1a1a24] text-gray-300 border-zinc-700 p-2 rounded focus:ring-cyan-400 focus:border-cyan-400 placeholder-gray-500"
                                           placeholder="z. B. Hegemony Command <h-com@core.gov>">
                                    @error('recipient')
                                    <span class="text-red-400 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Subject -->
                                <div>
                                    <label class="block text-gray-400 text-sm">Betreff</label>
                                    <input type="text" wire:model="subject"
                                           class="w-full bg-[#1a1a24] text-gray-300 border-zinc-700 p-2 rounded focus:ring-cyan-400 focus:border-cyan-400 placeholder-gray-500">
                                    @error('subject')
                                    <span class="text-red-400 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Body -->
                                <div>
                                    <label class="block text-gray-400 text-sm">Inhalt</label>
                                    <textarea wire:model="body"
                                              class="w-full bg-[#1a1a24] text-gray-300 border-zinc-700 p-2 rounded focus:ring-cyan-400 focus:border-cyan-400 placeholder-gray-500"
                                              rows="5"></textarea>
                                    @error('body')
                                    <span class="text-red-400 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Channel -->
                                <div>
                                    <label class="block text-gray-400 text-sm">Kanal</label>
                                    <select wire:model="channel"
                                            class="w-full bg-[#1a1a24] text-gray-300 border-zinc-700 p-2 rounded focus:ring-cyan-400 focus:border-cyan-400">
                                        <option value="Encrypted [LEVEL 1]">Encrypted [LEVEL 1]</option>
                                        <option value="Encrypted [LEVEL 2]">Encrypted [LEVEL 2]</option>
                                        <option value="Standard">Standard</option>
                                    </select>
                                    @error('channel')
                                    <span class="text-red-400 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Priority -->
                                <div>
                                    <label class="block text-gray-400 text-sm">Priorität</label>
                                    <select wire:model="priority"
                                            class="w-full bg-[#1a1a24] text-gray-300 border-zinc-700 p-2 rounded focus:ring-cyan-400 focus:border-cyan-400">
                                        <option value="normal">Normal</option>
                                        <option value="high">Hoch</option>
                                        <option value="critical">Kritisch</option>
                                    </select>
                                    @error('priority')
                                    <span class="text-red-400 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Send Button -->
                                <div>
                                    <button type="submit" x-data="{ isSending: {{ $isSending ? 'true' : 'false' }} }"
                                            @click="isSending = true; setTimeout(() => { isSending = false; }, 1000)"
                                            class="bg-cyan-400 text-black px-4 py-2 rounded hover:bg-cyan-300 transition-all duration-300">
                                        <span x-show="!isSending">[SENDEN]</span>
                                        <span x-show="isSending" class="animate-crt-flicker">SENDING... OK.</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <pre class="text-gray-400 mt-2">
└──────────────────────────────────────────────────────┘
                        </pre>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-window>
