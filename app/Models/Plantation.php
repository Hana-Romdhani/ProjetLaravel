<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'jardin_id', 'nom', 'date_plantation'];

    // Ensure date_plantation is treated as a date
    protected $casts = [
        'date_plantation' => 'date',
    ];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function jardin() {
        return $this->belongsTo(Jardin::class,'jardin_id');
    }

    public function plantes() {
        return $this->belongsToMany(Plantes::class, 'plantation_plante');
    }
}
