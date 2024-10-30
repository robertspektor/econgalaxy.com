<?php

namespace App\Livewire;

use App\Events\CompanyCreated;
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

        $company = Company::create([
            'name' => $this->name,
            'description' => $this->description,
            'user_id' => auth()->id(),
        ]);

        // save player origin
        auth()->user()->update([
            'player_origin_id' => $this->selected_player_origin,
        ]);

        $this->welcomeModal = false;

        CompanyCreated::dispatch($company->id);
    }
}
