<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FilesPanel extends Component
{
    public $files = [];
    public $used = 0;

    public function mount()
    {
        $user = auth()->user();
        $this->files = File::where('user_id', $user->id)->get();
        $this->used = $this->files->sum('size');
    }

    public function refreshFiles()
    {
        $user = auth()->user();
        $this->files = File::where('user_id', $user->id)->get();
        $this->used = $this->files->sum('size');
    }

    public function deleteFile($id)
    {
        $file = \App\Models\File::find($id);
        if ($file && $file->user_id === auth()->id()) {
            Storage::delete($file->path);
            $file->delete();
            $this->refreshFiles();
        }
    }

    protected $listeners = ['fileUploaded' => 'refreshFiles'];

    public function render()
    {
        return view('livewire.files-panel');
    }
}
