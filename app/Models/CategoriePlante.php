<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriePlante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',               // Name of the category
        'description',       // Description of the category
        'image_url',         // Image representing the category
        'parent_id',         // For hierarchical categories (optional)
        'slug',              // URL-friendly version of the name
    ];

    /**
     * Relationship to the plants in this category.
     */
    public function plantes()
    {
        return $this->hasMany(Plantes::class, 'categorie_plante_id');
    }

    /**
     * Relationship to the parent category (if using nested categories).
     */
    public function parent()
    {
        return $this->belongsTo(CategoriePlante::class, 'parent_id');
    }

    /**
     * Relationship to the child categories (if using nested categories).
     */
    public function children()
    {
        return $this->hasMany(CategoriePlante::class, 'parent_id');
    }
}
