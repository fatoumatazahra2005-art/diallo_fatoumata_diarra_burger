<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsCommande extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'burger_id',
        'quantity',
        'unit_price',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'quantity'   => 'integer',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function burger()
    {
        return $this->belongsTo(Burger::class);
    }

    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->unit_price;
    }
}
