<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RessourcesPartage extends Model
{
    use HasFactory;

    protected $fillable = ['user_emprunteur_id', 'user_preteur_id', 'ressource_id', 'quantite', 'date_partage', 'statut'];

    // Relation avec User pour l'emprunteur
    public function emprunteur()
    {
        return $this->belongsTo(User::class, 'user_emprunteur_id');
    }

    // Relation avec User pour le prêteur
    public function preteur()
    {
        return $this->belongsTo(User::class, 'user_preteur_id');
    }

    // Relation avec Ressource
    public function ressource()
    {
        return $this->belongsTo(Ressource::class, 'ressource_id');
    }

}
