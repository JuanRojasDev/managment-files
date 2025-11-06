<?php

use App\Livewire\Actions\Logout;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-500 to-violet-600">
    <div class="bg-white/10 rounded-2xl shadow-lg p-8 w-full max-w-md backdrop-blur-lg border border-white/20">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Verifica tu correo electrónico</h2>
        <p class="text-indigo-100 mb-6">Antes de continuar, por favor revisa tu correo y haz clic en el enlace de verificación.</p>

        <form wire:submit="sendVerification">
            <button type="submit" class="w-full py-2 px-4 bg-gradient-to-r from-indigo-500 to-violet-500 text-white rounded-xl font-semibold hover:opacity-90 transition">Reenviar correo de verificación</button>
        </form>

        <div class="text-right mt-2">
            <a href="{{ route('logout') }}" class="text-indigo-100 hover:underline text-sm" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>
    </div>
</div>
