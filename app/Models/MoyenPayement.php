<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoyenPayement extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'methode',
        'numero_carte',
        'date_expiration',
        'titulaire_carte',
        'cvv',
        'statut',
        'date_paiement',
    ];

    protected $casts = [
        'date_expiration' => 'date',
        'date_paiement' => 'datetime',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}