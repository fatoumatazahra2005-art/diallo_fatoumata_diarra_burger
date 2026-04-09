<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Les colonnes que l'on peut remplir en masse
    protected $fillable = [
        'name',
        'image',
        'price',
    ];
}
