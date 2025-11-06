<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status != Password::PASSWORD_RESET) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-500 to-violet-600">
    <div class="bg-white/10 rounded-2xl shadow-lg p-8 w-full max-w-md backdrop-blur-lg border border-white/20">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Restablecer contraseña</h2>

        <form wire:submit="resetPassword" class="space-y-4">
            <input type="hidden" wire:model="token">

            <div>
                <label for="email" class="block text-sm font-medium text-indigo-100">Correo electrónico</label>
                <input type="email" wire:model="email" id="email" class="mt-1 block w-full rounded-xl border-indigo-300 focus:border-violet-500 focus:ring-violet-500 transition" required autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-indigo-100">Nueva contraseña</label>
                <input type="password" wire:model="password" id="password" class="mt-1 block w-full rounded-xl border-indigo-300 focus:border-violet-500 focus:ring-violet-500 transition" required>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-indigo-100">Confirmar nueva contraseña</label>
                <input type="password" wire:model="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-xl border-indigo-300 focus:border-violet-500 focus:ring-violet-500 transition" required>
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-gradient-to-r from-indigo-500 to-violet-500 text-white rounded-xl font-semibold hover:opacity-90 transition">Restablecer</button>
        </form>
    </div>
</div>
