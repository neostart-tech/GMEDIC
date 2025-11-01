<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoBancaireResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->resource->id,
            'nom_banque'=>$this->resource->nom_banque,
        'titulaire_compte'=>$this->resource->titulaire_compte,
        'numero_compte'=>$this->resource->numero_compte,
        'code_iban'=>$this->resource->code_iban,
        'code_bic'=>$this->resource->code_bic,
        'instructions'=>$this->resource->instructions,
        'montant_minimum'=>$this->resource->montant_minimum,
        'est_actif'=>$this->resource->est_actif

        ];
    }
}
