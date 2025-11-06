<tbody>
  @foreach ($files as $file)
    <tr>
      <td class="py-2 px-3">{{ $file->name }}</td>
      <td class="py-2 px-3">{{ number_format($file->size/1024/1024, 2) }} MB</td>
      <td class="py-2 px-3">{{ $file->created_at->format('d/m/Y H:i') }}</td>
      <td class="py-2 px-3 text-indigo-600">
        🔽 Descargar
        <button wire:click="deleteFile({{ $file->id }})" class="ml-2 text-red-600 hover:underline" title="Eliminar archivo">🗑 Eliminar</button>
      </td>
    </tr>
  @endforeach
  @if(count($files) === 0)
    <tr><td colspan="4" class="py-2 px-3 text-center text-gray-400">No se encontraron archivos.</td></tr>
  @endif
</tbody>
