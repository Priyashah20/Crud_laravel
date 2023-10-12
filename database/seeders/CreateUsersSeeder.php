<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Arpita',
            'email' => 'arpita.parmar@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
