<div class="container py-4">
    <div class="space-y-6">
        <h2 class="text-xl font-bold text-blue-700 mb-4">Panel de Administración</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-2"><i class="fas fa-users text-blue-500"></i> Usuarios</h3>
                <livewire:admin-users />
            </div>
            <div class="bg-white rounded shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-2"><i class="fas fa-layer-group text-blue-500"></i> Grupos</h3>
                <livewire:admin-groups />
            </div>
            <div class="bg-white rounded shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-2"><i class="fas fa-cogs text-blue-500"></i> Configuración</h3>
                <livewire:admin-configs />
            </div>
        </div>
    </div>
</div>
