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
        'montant',
        'statut',
        'date_paiement',
        'date_encaissement',
        'numero_carte',
        'titulaire_carte',
        'date_expiration',
        'cvv',
        'info_bancaire_id',
        'reference_paiement',
        'banque',
        'numero_cheque',
        'preuve_paiement',
        'notes'
    ];

    protected $casts = [
        'date_paiement' => 'datetime',
        'date_encaissement' => 'datetime',
        'date_expiration' => 'date',
        'montant' => 'decimal:2'
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function infoBancaire()
    {
        return $this->belongsTo(InfoBancaire::class);
    }

    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    public function scopeEnAttenteValidation($query)
    {
        return $query->where('statut', 'en_attente_validation');
    }

    public function scopeEnAttenteEncaissement($query)
    {
        return $query->where('statut', 'en_attente_encaissement');
    }

    public function scopePaye($query)
    {
        return $query->where('statut', 'paye');
    }
}