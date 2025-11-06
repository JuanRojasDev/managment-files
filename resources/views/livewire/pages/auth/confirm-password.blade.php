<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-500 to-violet-600">
    <div class="bg-white/10 rounded-2xl shadow-lg p-8 w-full max-w-md backdrop-blur-lg border border-white/20">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Confirma tu contraseña</h2>

        <form wire:submit="confirmPassword" class="space-y-4">
            <div>
                <label for="password" class="block text-sm font-medium text-indigo-100">Contraseña</label>
                <input type="password" wire:model="password" id="password" class="mt-1 block w-full rounded-xl border-indigo-300 focus:border-violet-500 focus:ring-violet-500 transition" required autofocus>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-gradient-to-r from-indigo-500 to-violet-500 text-white rounded-xl font-semibold hover:opacity-90 transition">Confirmar</button>
        </form>
    </div>
</div>
