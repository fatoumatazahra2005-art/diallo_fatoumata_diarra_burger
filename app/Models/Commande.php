<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    const STATUS_EN_ATTENTE    = 'en_attente';
    const STATUS_EN_PREPARATION = 'en_preparation';
    const STATUS_PRETE         = 'prete';
    const STATUS_PAYEE         = 'payee';
    const STATUS_ANNULEE       = 'annulee';

    protected $fillable = [
        'user_id',
        'status',
        'total_price',
        'notes',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(DetailsCommande::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }

    public function isPaid(): bool
    {
        return $this->paiement()->exists();
    }
}
