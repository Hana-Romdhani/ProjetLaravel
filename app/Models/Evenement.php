<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;
    protected  $fillable=[
        'title',
        'location',
        'description',
        'date',
        'image',
        'classification_id',
        'admin_user_id'
    ];
// Relation avec la classification
public function classification()
{
    return $this->belongsTo(Classification::class);
}

public function adminUser()
{
    return $this->belongsTo(User::class, 'admin_user_id');
}
}
