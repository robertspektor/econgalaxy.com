<x-window :title="'Galactic Communicator'" :window-id="$id" :app="$app">
    <div class="grid grid-cols-3 gap-4 h-full">
        <!-- Email List -->
        <div class="col-span-1 border-r border-zinc-700">
            <div class="p-2 border-b border-zinc-700 text-gray-300 text-sm">Inbox</div>
            <ul class="space-y-1">
                @foreach($emails as $email)
                    <li wire:click="selectEmail({{ $email['id'] }})"
                        class="p-2 cursor-pointer hover:bg-[#2d2d3f] text-gray-400 {{ $selectedEmail && $selectedEmail['id'] === $email['id'] ? 'bg-[#2d2d3f]' : '' }}">
                        <div class="text-sm font-medium {{ $email['is_read'] ? '' : 'font-bold text-white' }}">
                            {{ $email['from'] }}
                            @if(!$email['is_read'])
                                <span class="ml-2 text-green-400">●</span>
                            @endif
                        </div>
                        <div class="text-xs">{{ $email['subject'] }}</div>
                        <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($email['received_at'])->format('Y-m-d H:i') }}</div>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Email Content -->
        <div class="col-span-2 p-4">
            @if($selectedEmail)
                <div class="border-b border-zinc-700 pb-2 mb-2">
                    <div class="text-gray-300 text-sm font-medium">{{ $selectedEmail['from'] }}</div>
                    <div class="text-gray-400 text-sm">{{ $selectedEmail['subject'] }}</div>
                </div>
                <div class="text-gray-400 whitespace-pre-wrap">{{ $selectedEmail['body'] }}</div>
                <div class="mt-4">
                    <a href="javascript:void(0)" wire:click="$dispatch('openApp', 'stellarBrowser')"
                       class="text-cyan-400 hover:text-cyan-300 underline">
                        Open Galactic Federation Portal
                    </a>
                </div>
            @else
                <div class="text-gray-500 text-sm">Select a message to view its content.</div>
            @endif
        </div>
    </div>
</x-window>
