<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class AdminUsers extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::with('group')->get();
    }

    public function render()
    {
        return view('livewire.admin-users', [
            'users' => $this->users
        ]);
    }
}
