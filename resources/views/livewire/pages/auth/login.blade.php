<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-indigo-600 via-indigo-400 to-indigo-200">
    <div class="bg-white/20 p-8 rounded-3xl shadow-2xl backdrop-blur-lg border border-white/30 max-w-lg w-full text-center">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-sm text-indigo-700" :status="session('status')" />

        <h2 class="text-3xl font-bold text-indigo-900 mb-4">Iniciar sesión</h2>

        <form wire:submit="login" class="space-y-4 text-left">
            <!-- Email Address -->
            <div>
                    <x-input-label for="email" :value="__('Correo electrónico')" class="text-indigo-700" />
                    <x-text-input wire:model.defer="form.email" id="email" class="block mt-1 w-full rounded-xl border-indigo-200 shadow-sm focus:ring-2 focus:ring-indigo-400" type="email" name="email" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div>
                    <x-input-label for="password" :value="__('Contraseña')" class="text-indigo-700" />
                    <x-text-input wire:model.defer="form.password" id="password" class="block mt-1 w-full rounded-xl border-indigo-200 shadow-sm focus:ring-2 focus:ring-indigo-400 text-black"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-indigo-700">{{ __('Recuérdame') }}</span>
                </label>
                <div class="ml-auto text-sm">
                    @if (Route::has('password.request'))
                        <a class="text-indigo-600 hover:underline" href="{{ route('password.request') }}" wire:navigate>¿Olvidaste tu contraseña?</a>
                    @endif
                </div>
            </div>

            <div>
                <button type="submit" class="w-full py-2 rounded-xl font-semibold text-white bg-gradient-to-r from-indigo-600 to-violet-600 hover:opacity-95 transition-shadow shadow-md">Iniciar sesión</button>
            </div>

            <p class="text-center text-sm text-indigo-700">¿No tienes cuenta? <a href="{{ route('register') }}" class="font-medium text-violet-600 hover:underline">Regístrate</a></p>
        </form>
    </div>
</div>
