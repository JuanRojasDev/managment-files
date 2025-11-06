<div class="flex flex-col items-center justify-center gap-4 p-6 border-2 border-dashed border-indigo-300 rounded-2xl bg-white/20 backdrop-blur-lg shadow-lg">
  <form wire:submit.prevent="upload" class="w-full flex flex-col items-center gap-4">
    <div class="flex flex-col items-center gap-2">
      <div class="bg-indigo-100 text-indigo-600 rounded-full p-4 mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12" /></svg>
      </div>
      <label for="fileInput" class="cursor-pointer inline-flex items-center gap-2 bg-gradient-to-r from-indigo-500 to-violet-500 text-white px-6 py-3 rounded-xl shadow hover:opacity-90 transition">📤 Seleccionar archivo</label>
      <input type="file" wire:model="file" id="fileInput" class="hidden">
      <span class="text-sm text-white" id="fileName">@isset($file) {{ $file->getClientOriginalName() }} @else Ningún archivo seleccionado @endisset</span>
    </div>
    <div class="w-full flex justify-center items-center min-h-[80px]">
      @isset($file)
        <div class="bg-white/80 rounded-xl p-4 shadow text-center">
          <span class="text-indigo-700 font-semibold">Vista previa:</span>
          @if(str_starts_with($file->getMimeType(), 'image/'))
            <img src="{{ $file->temporaryUrl() }}" class="mx-auto mt-2 max-h-32 rounded-lg shadow" alt="preview">
          @else
            <span class="block mt-2 text-gray-600">{{ $file->getClientOriginalName() }}</span>
          @endif
        </div>
      @endisset
    </div>
    <button type="submit" class="mx-auto bg-white text-indigo-700 font-semibold px-6 py-2 rounded-xl border border-indigo-300 hover:bg-indigo-50 transition">Subir</button>
    <div wire:loading wire:target="file" class="text-sm text-indigo-400">Cargando archivo...</div>
  </form>
  <div class="mt-3 text-sm">
    @if(is_array($message) && isset($message['type']))
      @if($message['type'] === 'error')
        <div class="text-red-500 font-semibold">{{ $message['text'] }}</div>
      @else
        <div class="text-green-500 font-semibold">{{ $message['text'] }}</div>
      @endif
    @elseif(is_string($message) && !empty($message))
      <div class="text-indigo-500 font-semibold">{{ $message }}</div>
    @endif
  </div>
</div>
