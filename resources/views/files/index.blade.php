@extends('layouts.app')
@section('title','Archivos')
@section('page-title','Mis archivos')
@section('content')
<div class="max-w-5xl mx-auto">
  <div class="bg-white/10 p-6 rounded-2xl backdrop-blur-lg border border-white/20 mb-8">
    <h3 class="text-lg font-semibold text-indigo-100 mb-4">Subir nuevo archivo</h3>
    <livewire:upload-manager />
  </div>
  <div class="bg-white p-6 rounded-2xl text-gray-800 shadow-xl">
    <h3 class="text-lg font-semibold mb-4 text-indigo-700">Todos mis archivos</h3>
    <table class="w-full text-left border-collapse">
      <thead class="bg-indigo-50 text-indigo-700">
        <tr>
          <th class="py-2 px-3 rounded-l-lg">Nombre</th>
          <th class="py-2 px-3">Tamaño</th>
          <th class="py-2 px-3">Fecha</th>
          <th class="py-2 px-3 rounded-r-lg">Acciones</th>
        </tr>
      </thead>
      @livewire('files-panel')
    </table>
  </div>
</div>
@endsection
