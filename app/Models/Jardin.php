<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jardin extends Model
{
    use HasFactory;

        // Define which attributes can be mass assigned
        protected $fillable = ['name', 'location', 'description', 'size','image'];

}
