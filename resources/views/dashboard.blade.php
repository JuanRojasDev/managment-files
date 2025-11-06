@extends('layouts.app')
@section('title','Dashboard')
@section('page-title',auth()->user()->role === 'admin' ? 'Panel de Administración' : 'Mi almacenamiento')
@section('content')
@if (auth()->user()->role === 'admin')
    <livewire:admin-panel />
@else
    <livewire:user-panel />
@endif
@endsection
