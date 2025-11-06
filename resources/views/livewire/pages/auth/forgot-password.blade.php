<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink($this->only('email'));

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
};?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-indigo-400 to-indigo-200">
    <div class="bg-white/20 rounded-2xl shadow-lg p-8 w-full max-w-md backdrop-blur-lg border border-white/30">
        <h2 class="text-2xl font-bold text-indigo-900 mb-6 text-center">Recuperar contraseña</h2>
        <form wire:submit="sendPasswordResetLink" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-indigo-800">Correo electrónico</label>
                <input type="email" wire:model="email" id="email"
                    class="mt-1 block w-full rounded-xl border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500 transition"
                    required autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <button type="submit"
                class="w-full py-2 px-4 bg-gradient-to-r from-indigo-600 to-indigo-400 text-white rounded-xl font-semibold hover:opacity-90 transition">Enviar
                enlace</button>
            <div class="text-right mt-2">
                <a href="{{ route('login') }}" class="text-indigo-800 hover:underline text-sm">¿Ya tienes cuenta? Inicia
                    sesión</a>
            </div>
        </form>
    </div>
</div>
