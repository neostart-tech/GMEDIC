<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InfoBancaire;

class InfoBancaireSeeder extends Seeder
{
    public function run()
    {
        InfoBancaire::create([
            'nom_banque' => 'UBA',
            'titulaire_compte' => 'MEDICAL EQUIPEMENT SARL',
            'numero_compte' => '01234567890',
            'code_iban' => 'CI051 CI001 01234567890 01',
            'code_bic' => 'UNACCICI',
            'instructions' => 'Veuillez indiquer le numéro de commande dans la référence du virement. Un justificatif sera requis pour validation.',
            'montant_minimum' => 10000,
            'est_actif' => true
        ]);

        InfoBancaire::create([
            'nom_banque' => 'SGBCI',
            'titulaire_compte' => 'MEDICAL EQUIPEMENT SARL',
            'numero_compte' => '98765432100',
            'code_iban' => 'CI051 SG001 98765432100 02',
            'code_bic' => 'SGCICICI',
            'instructions' => 'Merci de nous transmettre le justificatif de virement par email après paiement.',
            'montant_minimum' => 5000,
            'est_actif' => true
        ]);
    }
}
