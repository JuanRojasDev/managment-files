@extends('layouts.app')
@section('title','Administración')
@section('page-title','Panel de Administración')
@section('content')
<div class="max-w-6xl mx-auto grid gap-8 lg:grid-cols-3">
  <div class="bg-white/10 p-6 rounded-2xl backdrop-blur-lg border border-white/20">
    <h3 class="text-lg font-semibold text-indigo-100 mb-4">Usuarios</h3>
    @livewire('admin-users')
  </div>
  <div class="bg-white/10 p-6 rounded-2xl backdrop-blur-lg border border-white/20">
    <h3 class="text-lg font-semibold text-indigo-100 mb-4">Grupos</h3>
    @livewire('admin-groups')
  </div>
  <div class="bg-white/10 p-6 rounded-2xl backdrop-blur-lg border border-white/20">
    <h3 class="text-lg font-semibold text-indigo-100 mb-4">Configuración</h3>
    @livewire('admin-configs')
  </div>
</div>
@endsection
