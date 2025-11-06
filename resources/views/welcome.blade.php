@extends('layouts.app')
@section('title', 'Bienvenido')
@section('content')
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-indigo-600 via-indigo-400 to-indigo-200">
        <div
            class="bg-white/20 p-8 rounded-3xl shadow-2xl backdrop-blur-lg border border-white/30 max-w-lg w-full text-center">
            <h1 class="text-3xl font-bold text-indigo-900 mb-4">Gestor de Archivos Seguro</h1>
            <p class="text-indigo-800 mb-6">Bienvenido a tu prueba técnica. Administra, sube y elimina tus archivos de forma
                segura y moderna.</p>
            <div class="flex flex-col gap-4">
                <a href="{{ route('login') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition">Iniciar
                    sesión</a>
                <a href="{{ route('register') }}"
                    class="bg-white/80 hover:bg-white text-indigo-700 font-semibold py-3 rounded-xl border border-indigo-300 transition">Registrarse</a>
            </div>
        </div>
    </div>
@endsection
