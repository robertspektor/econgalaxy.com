<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Faction;
use App\Models\PlayerOrigin;
use App\Models\User;
use Flux\Flux;
use Livewire\Component;

class StartGameHelper extends Component
{
    public $welcomeModal = true;

    public string $name = '';

    public string $description = '';

    public int $selected_player_origin = 0;

    public function render()
    {
        if (User::find(auth()->id())->company) {
            $this->welcomeModal = false;
        }

        return view('livewire.start-game-helper', [
            'factions' => Faction::all(),
            'player_origins' => PlayerOrigin::all(),
        ]);
    }

    public function startGame()
    {
        Flux::modal('edit-profile')->show();
    }

    public function chooseOrigin(int $originId): void
    {
        $this->selected_player_origin = $originId;
    }

    public function submit(): void
    {
        $this->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        Company::create([
            'name' => $this->name,
            'description' => $this->description,
            'user_id' => auth()->id(),
        ]);

        $this->welcomeModal = false;
    }
}
