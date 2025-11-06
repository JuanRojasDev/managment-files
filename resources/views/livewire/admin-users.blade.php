<div>
    <h5>Gestión de Usuarios</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Grupo</th>
            </tr>
        </thead>
            <tbody>
            @isset($users)
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role ?? '-' }}</td>
                        <td>{{ $user->group->name ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-gray-400">No hay usuarios disponibles.</td></tr>
                @endforelse
            @else
                <tr><td colspan="4" class="text-center text-gray-400">No se encontraron usuarios.</td></tr>
            @endisset
        </tbody>