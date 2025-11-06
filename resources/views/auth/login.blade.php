@extends('layouts.app')
@section('title','Iniciar sesión')
@section('page-title','Iniciar sesión')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-indigo-400 to-indigo-200">
    <div class="bg-white/20 rounded-2xl shadow-lg p-8 w-full max-w-md backdrop-blur-lg border border-white/30">
        <h2 class="text-2xl font-bold text-indigo-900 mb-6 text-center">Iniciar sesión</h2>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-indigo-800">Correo electrónico</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full rounded-xl border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500 transition" required autofocus>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-indigo-800">Contraseña</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-xl border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500 transition text-black placeholder-indigo-400" autocomplete="current-password" required>
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-gradient-to-r from-indigo-600 to-indigo-400 text-white rounded-xl font-semibold hover:opacity-90 transition">Entrar</button>
            <div class="text-right mt-2">
                <a href="{{ route('password.request') }}" class="text-indigo-800 hover:underline text-sm">¿Olvidaste tu contraseña?</a>
            </div>
        </form>
    </div>
</div>
@endsection
