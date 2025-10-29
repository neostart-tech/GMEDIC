<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoBancaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_banque',
        'titulaire_compte',
        'numero_compte',
        'code_iban',
        'code_bic',
        'instructions',
        'montant_minimum',
        'est_actif'
    ];

    protected $casts = [
        'montant_minimum' => 'decimal:2',
        'est_actif' => 'boolean'
    ];

    public function scopeActif($query)
    {
        return $query->where('est_actif', true);
    }
}