<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class CreateUserCommand extends Command
{
    protected $signature = 'user:create {name} {email} {password}';
    protected $description = 'Créer un nouvel utilisateur';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Log pour vérifier les entrées
        $this->info("Tentative de création d'utilisateur : {$name}, {$email}");

        // Créer l'utilisateur
        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);

            // Créer un token
            $token = $user->createToken('Default Token')->plainTextToken;
    
            // Confirmer la création de l'utilisateur et afficher le token
            $this->info("Utilisateur {$user->name} créé avec succès !");
            $this->info("Token : {$token}");
        } catch (\Exception $e) {
            $this->error("Erreur lors de la création de l'utilisateur : " . $e->getMessage());
        }
    }

}
