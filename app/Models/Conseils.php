<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conseils extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['titre','question','contenus','user_id','category_id','image_url','video_url'];
    public function category()
    {
        return $this->belongsTo(CategorieConseil::class, 'category_id');
    }
}
