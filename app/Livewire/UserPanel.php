<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\File;

class UserPanel extends Component
{
    use WithFileUploads;

    public $file;
    public $files = [];
    public $used = 0;
    public $limit = 10485760; // 10 MB por defecto
    public $progress = 0;
    public $message = '';

    public function mount()
    {
        $user = auth()->user();
        $this->limit = $user->storage_limit ?? ($user->group->storage_limit ?? $this->limit);
        $this->files = File::where('user_id', $user->id)->get();
        $this->used = $this->files->sum('size');
    }

    public function uploadFile()
    {
        $user = auth()->user();
        $this->limit = $user->storage_limit ?? ($user->group->storage_limit ?? $this->limit);
        $this->files = File::where('user_id', $user->id)->get();
        $this->used = $this->files->sum('size');

        if (!$this->file) {
            $this->message = 'Selecciona un archivo.';
            return;
        }
        $size = $this->file->getSize();
        $ext = $this->file->getClientOriginalExtension();
        $prohibidas = ['exe','bat','js','php','sh'];
        if (in_array(strtolower($ext), $prohibidas)) {
            $this->message = 'Extensión prohibida.';
            return;
        }
        if (($this->used + $size) > $this->limit) {
            $this->message = 'Supera el límite de almacenamiento.';
            return;
        }
        $path = $this->file->store('files');
        File::create([
            'user_id' => $user->id,
            'group_id' => $user->group_id,
            'name' => $this->file->getClientOriginalName(),
            'path' => $path,
            'size' => $size,
            'extension' => $ext,
        ]);
        $this->message = 'Archivo subido correctamente.';
        $this->file = null;
        $this->mount();
    }

    public function refreshFiles()
    {
        $user = auth()->user();
        $this->files = File::where('user_id', $user->id)->get();
        $this->used = $this->files->sum('size');
    }

    protected $listeners = ['fileUploaded' => 'refreshFiles'];

    public function render()
    {
        return view('livewire.user-panel');
    }
}
