<?php

namespace App\Livewire\Apps;

use Livewire\Component;
use App\Models\Message;

class GalacticCommunicator extends Component
{
    public $id;
    public $app;
    public $selectedEmail = null;
    public $emails = [];

    public function mount($id, $app)
    {
        $this->id = $id;
        $this->app = $app;

        $this->emails = Message::where('user_id', auth()->id())
            ->orderBy('received_at', 'desc')
            ->get()
            ->toArray();
    }

    public function selectEmail($emailId)
    {
        $this->selectedEmail = collect($this->emails)->firstWhere('id', $emailId);
        if ($this->selectedEmail && !$this->selectedEmail['is_read']) {
            Message::where('id', $emailId)->update(['is_read' => true]);
            $this->emails = Message::where('user_id', auth()->id())
                ->orderBy('received_at', 'desc')
                ->get()
                ->toArray();
        }
    }

    public function render()
    {
        return view('livewire.apps.galactic-communicator');
    }
}
