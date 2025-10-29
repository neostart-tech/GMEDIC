<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'adresse_id',
        'date_commande',
        'statut',
        'total',
        'commentaires',
    ];

    protected $casts = [
        'date_commande' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function adresse()
    {
        return $this->belongsTo(Adresse::class);
    }

    public function details()
    {
        return $this->hasMany(DetailCommande::class);
    }

    public function paiement()
    {
        return $this->hasOne(MoyenPayement::class);
    }
}