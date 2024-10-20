<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;

        // Define which attributes can be mass assigned
        protected $fillable = ['nom', 'libelle', 'quantite','image', 'owner'];

         // Relation avec le modèle User
        public function user()
        {
            return $this->belongsTo(User::class, 'owner');
        }

}
