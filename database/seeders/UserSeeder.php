<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'Gestionnaire',
            'email'    => 'fatoumatazahra2005@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'gestionnaire',
        ]);

        User::create([
            'name'     => 'Client Test',
            'email'    => 'fazahlily13@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'client',
        ]);
    }
}
