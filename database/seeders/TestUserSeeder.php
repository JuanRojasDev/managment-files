<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class TestUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'rojassalinasjuanandres@gmail.com'],
            [
                'name' => 'Juan Rojas',
                'password' => bcrypt('secret123'),
            ]
        );
    }
}
