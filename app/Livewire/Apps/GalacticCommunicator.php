<?php

namespace App\Livewire\Apps;

use Livewire\Component;
use App\Models\Message;

class GalacticCommunicator extends Component
{
    public $id;
    public $app;
    public $selectedMessage = null;
    public $currentFolder = 'inbox';
    public $isComposing = false;
    public $recipient = '';
    public $subject = '';
    public $body = '';
    public $channel = 'Encrypted [LEVEL 1]';
    public $priority = 'normal';
    public $isSending = false;

    protected $rules = [
        'recipient' => 'required|string|max:255',
        'subject' => 'required|string|max:255',
        'body' => 'required|string|max:1000',
        'channel' => 'required|string|max:255',
        'priority' => 'required|in:normal,high,critical',
    ];

    public function mount($id, $app)
    {
        $this->id = $id;
        $this->app = $app;
    }

    public function selectFolder($folder)
    {
        $this->currentFolder = $folder;
        $this->selectedMessage = null;
        $this->isComposing = false;
    }

    public function selectMessage($messageId)
    {
        $this->selectedMessage = Message::findOrFail($messageId);
        if (!$this->selectedMessage->is_read) {
            $this->selectedMessage->update(['is_read' => true]);
        }
        $this->isComposing = false;
    }

    public function startComposing()
    {
        $this->isComposing = true;
        $this->selectedMessage = null;
        $this->recipient = '';
        $this->subject = '';
        $this->body = '';
        $this->channel = 'Encrypted [LEVEL 1]';
        $this->priority = 'normal';
    }

    public function sendMessage()
    {
        $this->validate();

        $this->isSending = true;

        Message::create([
            'user_id' => auth()->id(),
            'from' => auth()->user()->name . ' <' . auth()->user()->email . '>',
            'to' => $this->recipient,
            'subject' => $this->subject,
            'body' => $this->body,
            'channel' => $this->channel,
            'priority' => $this->priority,
            'folder' => 'sent',
            'is_read' => true,
            'received_at' => now(),
        ]);

        // Simuliere das Senden (wird clientseitig visualisiert)
        $this->isSending = false;
        $this->isComposing = false;
    }

    public function openBrowserLink($url)
    {
        $this->dispatch('openApp', 'stellarBrowser');
        // Hier könnte man zusätzlich die URL an StellarBrowser weitergeben
    }

    public function render()
    {
        $messages = Message::where('user_id', auth()->id())
            ->where('folder', $this->currentFolder)
            ->orderBy('received_at', 'desc')
            ->get();

        return view('livewire.apps.galactic-communicator', [
            'messages' => $messages,
        ]);
    }
}
