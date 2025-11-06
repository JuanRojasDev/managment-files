<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\File;
use App\Models\User;

class UploadManager extends Component
{
    use WithFileUploads;

    public $file;
    public $message = '';

    public function upload()
    {
        $user = auth()->user();
        $limit = $user->storage_limit ?? ($user->group->storage_limit ?? 10485760);
        $used = File::where('user_id', $user->id)->sum('size');
        $prohibidas = ['exe','bat','js','php','sh'];

        if (!$this->file) {
            $this->message = ['type'=>'error','text'=>'Selecciona un archivo.'];
            return;
        }
        $size = $this->file->getSize();
        $ext = $this->file->getClientOriginalExtension();

        if (in_array(strtolower($ext), $prohibidas)) {
            $this->message = ['type'=>'error','text'=>'Extensión prohibida.'];
            return;
        }
        if (($used + $size) > $limit) {
            $this->message = ['type'=>'error','text'=>'Supera el límite de almacenamiento.'];
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
        $this->message = ['type'=>'success','text'=>'Archivo subido correctamente.'];
        $this->file = null;
        $this->dispatch('fileUploaded');
    }

    public function render()
    {
        return view('livewire.upload-manager');
    }
}
