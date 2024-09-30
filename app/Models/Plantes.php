<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantes extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',                // Name of the plant
        'nom_scientifique',   // Scientific name
        'description',        // Detailed description
        'image_url',          // URL to an image of the plant
        'famille',            // Plant family
        'origine',            // Origin or native region
        'categorie_plante_id',// Foreign key to the plant category
        'type',               // Type (e.g., annual, perennial)
        'exposition',         // Sunlight requirements (e.g., full sun, partial shade)
        'arrosage',           // Watering needs
        'type_sol',           // Preferred soil type
        'periode_plantation', // Planting period
        'periode_floraison',  // Flowering period
        'hauteur_max',        // Maximum height
        'largeur_max',        // Maximum width
        'croissance',         // Growth rate
        'besoins_speciaux',   // Special needs or considerations
        'utilisations',       // Uses (e.g., ornamental, edible)
        'conseils_entretien', // Care tips
    ];

    /**
     * Relationship to the plant category.
     */
    public function categorie()
    {
        return $this->belongsTo(CategoriePlante::class, 'categorie_plante_id');
    }
}
