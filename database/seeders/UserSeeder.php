<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
{
    User::create([
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'role' => 'admin',
        'password' => Hash::make('ndindy@722'),
    ]);

    User::create([
        'name' => 'Prof 1',
        'email' => 'prof1@gmail.com',
        'role' => 'enseignant',
        'password' => Hash::make('prof123'),
    ]);

    User::create([
        'name' => 'Etudiant 1',
        'email' => 'etu1@gmail.com',
        'role' => 'etudiant',
        'password' => Hash::make('etu123'),
    ]);
}

}
