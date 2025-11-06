@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">Panel de Administrador</h2>
    <div class="card mb-4">
        <div class="card-body">
            <nav class="nav nav-pills flex-column flex-sm-row mb-3">
                <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('admin.users.index') }}">Usuarios</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('admin.groups.index') }}">Grupos</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('admin.configs.index') }}">Configuraciones</a>
            </nav>
            <div id="adminContent">
                <!-- Aquí se cargará la gestión de usuarios, grupos y configuraciones -->
            </div>
        </div>
    </div>
</div>
<script src="/js/admin.js"></script>
@endsection
