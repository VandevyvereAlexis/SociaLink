<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void 
     */
    public function run(): void
    {
        // creation de l'administrateur
        User::create([
            'pseudo' => 'administrateur',
            'password' => Hash::make('Administrateur1998!'),
            'email' => 'administrateur@administrateur.fr',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role_id' => 2
        ]);

        // creation d'un utilisateur de test
        User::create([
            'pseudo' => 'utilisateur',
            'password' => Hash::make('Utilisateur1998!'),
            'email' => 'utilisateur@utilisateur.fr',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role_id' => 1
        ]);

        // creation de 8 users aleatoires 
        User::factory(8)->create();
    }
}
