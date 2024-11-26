<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Cliente Teste 1',
            'email' => 'cliente1@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Cliente Teste 2',
            'email' => 'cliente2@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Cliente Teste 3',
            'email' => 'cliente3@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
