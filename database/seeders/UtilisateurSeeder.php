<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UtilisateurSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administration',
            'email'    => 'admin@est.ma',
            'password' => Hash::make('password123'),
            'role'     => 'administration',
        ]);

        User::create([
            'name'     => 'Administrateur',
            'email'    => 'superadmin@est.ma',
            'password' => Hash::make('password123'),
            'role'     => 'administrateur',
        ]);
    }
}