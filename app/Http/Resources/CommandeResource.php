<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\AdresseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommandeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id'=>$this->resource->id,
        'user_id'=>$this->resource->user_id,
        'adresse_id'=>$this->resource->adresse_id,
        'date_commande'=>$this->resource->date_commande,
        'statut'=>$this->resource->statut,
        'total'=>$this->resource->total,
        'commentaires'=>$this->resource->commentaires,
        'numero_commande'=>$this->resource->numero_commande,
        'adresse'=> new AdresseResource($this->whenLoaded('adresse')),
        'user'=> new UserResource($this->whenLoaded('user')),
        'paiement'=>new MoyenPaiementResource($this->whenLoaded('paiement')),
        "detail_commandes"=>DetailCommandeResource::collection($this->whenLoaded("details")),
        
        ];
    }
}
