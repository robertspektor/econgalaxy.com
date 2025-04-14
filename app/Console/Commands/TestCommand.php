<?php

namespace App\Console\Commands;

use App\Events\CompanyCreated;
use App\Models\Message;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // user id 1
        $user = \App\Models\User::find(1);

        Message::create([
            'user_id' => $user->id,
            'from' => 'Galactic Federation',
            'subject' => 'Welcome to the Galactic Federation',
            'body' => "Welcome, {$user->name}!\n\nYou have successfully registered with the Galactic Federation. We are pleased to welcome you to the ranks of interstellar entrepreneurs.\n\nTo begin your journey, please access the Galactic Federation Portal via your in-game browser and fill out the application form to establish your company.\n\nYou can find the portal link in your Galactic Communicator app after logging in.\n\nBest regards,\nThe Galactic Federation",
            'channel' => 'Encrypted [LEVEL 2]',
            'priority' => 'high',
            'folder' => 'inbox',
            'is_read' => false,
            'received_at' => now(),
        ]);
    }
}
