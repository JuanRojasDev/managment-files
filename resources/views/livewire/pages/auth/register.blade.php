<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component {};
?>

<div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-indigo-600 via-indigo-400 to-indigo-200">
    <div class="bg-white/20 p-8 rounded-3xl shadow-2xl backdrop-blur-lg border border-white/30 max-w-lg w-full text-center">
        <h1 class="text-3xl font-bold text-indigo-900 mb-4">Crear cuenta</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-4 text-left">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-indigo-700">Nombre completo</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full rounded-xl border-indigo-200 shadow-sm focus:ring-2 focus:ring-indigo-400" required autofocus>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-indigo-700">Correo electrónico</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full rounded-xl border-indigo-200 shadow-sm focus:ring-2 focus:ring-indigo-400" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-indigo-700">Contraseña</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-xl border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500 transition" required>
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-indigo-700">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-xl border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500 transition" required>
            </div>
            <button type="submit" class="w-full py-2 rounded-xl font-semibold text-white bg-gradient-to-r from-indigo-600 to-violet-600 hover:opacity-95 transition-shadow shadow-md">Registrarse</button>
            <p class="text-center text-sm text-indigo-700">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="font-medium text-violet-600 hover:underline">Inicia sesión</a></p>
        </form>
    </div>
</div>
