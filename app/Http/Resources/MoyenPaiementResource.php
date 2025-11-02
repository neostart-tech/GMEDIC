<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\InfoBancaireResource;

class MoyenPaiementResource extends JsonResource
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
        'commande_id'=>$this->resource->commande_id,
        'methode'=>$this->resource->methode,
        'montant'=>$this->resource->montant,
        'statut'=>$this->resource->statut,
        'date_paiement'=>$this->resource->date_paiement,
        'date_encaissement'=>$this->resource->date_encaissement,
        'numero_carte'=>$this->resource->numero_carte,
        'titulaire_carte'=>$this->resource->titulaire_carte,
        'date_expiration'=>$this->resource->date_expiration,
        'cvv'=>$this->resource->cvv,
        'info_bancaire_id'=>$this->resource->info_bancaire_id,
        'reference_paiement'=>$this->resource->reference_paiement,
        'banque'=>$this->resource->banque,
        'banque'=>$this->resource->banque,
        'preuve_paiement'=>$this->resource->path(),
        'notes'=>$this->resource->notes,
        'info_bancaire'=>new InfoBancaireResource($this->whenLoaded('infoBancaire'))

        ];
    }
}
