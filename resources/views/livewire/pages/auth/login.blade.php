<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public bool $isLoggingIn = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        try {
            $this->form->authenticate();
            Session::regenerate();
            $this->isLoggingIn = true;
            $this->redirectIntended(default: route('boot', absolute: false), navigate: true);
        } catch (\Exception $e) {
            $this->addError('email', $e->getMessage());
        }
    }
}; ?>

<div x-data="{ isLoggingIn: @entangle('isLoggingIn') }" x-show="!isLoggingIn" x-transition:leave="transition-opacity duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="relative">
    <!-- Terminal Window -->
    <div class="relative bg-[#23232f] p-6 rounded shadow-xl w-full border border-zinc-700">
        <!-- Terminal Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-cyan-400 text-lg animate-crt-flicker">Access Terminal</h2>
            <div class="flex gap-1">
                <span class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
                <span class="w-3 h-3 bg-yellow-400 rounded-full animate-pulse delay-150"></span>
                <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse delay-300"></span>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-green-400 text-sm" :status="session('status')" />

        <!-- Login Form -->
        <x-mary-form wire:submit="login">
            <!-- Email Address -->
            <div>
                <x-mary-input wire:model="form.email"
                              label="{{__('Email')}}"
                              placeholder="Enter your email address"
                              class="bg-[#1a1a24] text-gray-300 border-zinc-700 focus:ring-cyan-400 focus:border-cyan-400 placeholder-gray-500"
                              label-class="text-gray-400 text-sm"
                              input-class="hover:border-cyan-400 transition-all duration-300" />
                @error('email')
                <span class="text-red-400 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-mary-input wire:model="form.password"
                              label="{{__('Password')}}"
                              type="password"
                              placeholder="Enter your password"
                              class="bg-[#1a1a24] text-gray-300 border-zinc-700 focus:ring-cyan-400 focus:border-cyan-400 placeholder-gray-500"
                              label-class="text-gray-400 text-sm"
                              input-class="hover:border-cyan-400 transition-all duration-300" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember"
                           id="remember"
                           type="checkbox"
                           class="rounded bg-[#1a1a24] border-zinc-700 text-cyan-400 focus:ring-cyan-400">
                    <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-400 hover:text-cyan-400 transition-all duration-300"
                       href="{{ route('password.request') }}"
                       wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-mary-button type="submit"
                               class="bg-cyan-400 text-black px-4 py-2 rounded hover:bg-cyan-300 transition-all duration-300">
                    {{ __('Log in') }}
                </x-mary-button>
            </div>
        </x-mary-form>

        <!-- Terminal Prompt -->
        <div class="mt-4 text-gray-500 text-sm animate-crt-flicker">
            [Enter Credentials to Proceed]
        </div>
    </div>
</div>

