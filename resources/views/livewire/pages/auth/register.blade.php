<?php

use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class, 'alpha_dash'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        $user = App\Models\User::first();
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

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <flux:input wire:model="username" label="{{__('Username')}}" placeholder="Please enter your username"/>
            <flux:error for="username" class="mt-2"/>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <flux:input wire:model="email" label="{{__('Email')}}" placeholder="Please enter your email address"/>
            <flux:error for="email" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <flux:input wire:model="password" label="{{__('Password')}}" type="password"
                        placeholder="Please enter your password"/>
            <flux:error for="password" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <flux:input wire:model="password_confirmation" label="{{__('Confirm Password')}}" type="password"
                        placeholder="Please confirm your password"/>
            <flux:error for="password_confirmation" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
               href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
