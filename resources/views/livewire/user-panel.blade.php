<div>
    <!-- Panel de Usuario Moderno -->
    <div class="container py-4">
        <h2 class="mb-4">Panel de Usuario</h2>
        <div class="max-w-5xl mx-auto grid gap-8 lg:grid-cols-3">
            <div class="lg:col-span-1 bg-white/10 p-6 rounded-2xl backdrop-blur-lg border border-white/20">
                <h3 class="text-sm text-indigo-100">Uso actual</h3>
                <div class="mt-4 flex items-center justify-between">
                    <div>
                        <p class="text-3xl font-bold text-white">{{ number_format($used/1024/1024, 2) }} MB</p>
                        <p class="text-sm text-indigo-200">de {{ number_format($limit/1024/1024, 2) }} MB</p>
                    </div>
                    <div class="relative">
                        <svg viewBox="0 0 36 36" class="w-20 h-20">
                            <path d="M18 2a16 16 0 1 0 0 32 16 16 0 1 0 0-32" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="3" />
                            <path d="M18 2a16 16 0 1 0 0 32" fill="none" stroke="#A78BFA" stroke-width="3" stroke-dasharray="{{ round(($used/$limit)*100) }},100" />
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center text-white font-bold text-sm">{{ round(($used/$limit)*100) }}%</div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white p-6 rounded-2xl text-gray-800 shadow-xl">
                <h3 class="text-lg font-semibold mb-4 text-indigo-700">Subir archivo</h3>
                <form wire:submit.prevent="uploadFile" class="space-y-4">
                    <div class="flex items-center gap-2">
                        <input type="file" wire:model="file" class="block w-full border border-indigo-300 rounded-xl px-2 py-1 focus:border-violet-500 focus:ring-violet-500 transition" required>
                        <button type="submit" class="bg-gradient-to-r from-indigo-500 to-violet-500 text-white px-6 py-2 rounded-xl shadow hover:opacity-90 transition"><i class="fas fa-upload"></i> Subir</button>
                    </div>
                    @if ($progress)
                        <div class="w-full bg-indigo-100 rounded-xl h-3 mt-2">
                            <div class="bg-violet-500 h-3 rounded-xl transition-all" style="width: {{ $progress }}%"></div>
                        </div>
                    @endif
                    @if ($message)
                        <div class="mt-2">
                            <script>
                                Swal.fire({icon: '{{ $message == "Archivo subido correctamente." ? "success" : "error" }}', text: '{{ $message }}', timer: 2000, showConfirmButton: false});
                            </script>
                        </div>
                    @endif
                </form>

                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-indigo-700 mb-3">Mis archivos</h3>
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-indigo-50 text-indigo-700">
                            <tr>
                                <th class="py-2 px-3 rounded-l-lg">Nombre</th>
                                <th class="py-2 px-3">Tamaño</th>
                                <th class="py-2 px-3">Fecha</th>
                                <th class="py-2 px-3 rounded-r-lg">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($files as $file)
                                <tr>
                                    <td class="py-2 px-3">{{ $file->name }}</td>
                                    <td class="py-2 px-3">{{ number_format($file->size/1024/1024, 2) }} MB</td>
                                    <td class="py-2 px-3">{{ $file->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="py-2 px-3 text-indigo-600">🔽 Descargar</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
