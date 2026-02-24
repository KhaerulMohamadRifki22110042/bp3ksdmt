<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // PELATIH
        User::create([
            'name' => 'Pelatih',
            'email' => 'pelatih@mail.com',
            'password' => Hash::make('pelatih123'),
            'role' => 'pelatih',
        ]);

        // PESERTA
        User::create([
            'name' => 'Peserta',
            'email' => 'peserta@mail.com',
            'password' => Hash::make('peserta123'),
            'role' => 'peserta',
        ]);
    }
}
