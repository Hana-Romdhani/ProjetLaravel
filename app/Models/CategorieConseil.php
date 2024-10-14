<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieConseil extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    public function conseils()
    {
        return $this->hasMany(Conseils::class, 'category_id');
    }
}
