<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ArticleResource;

class DetailCommandeResource extends JsonResource
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
        'commande_id'=>$this->resource->commande->id,
        'article_id'=>$this->resource->article_id,
        'quantite'=>$this->resource->quantite,
        'prix_unitaire'=>$this->resource->prix_unitaire,
        'commande'=>new CommandeResource($this->whenLoaded('commande')),
        'article'=>new ArticleResource($this->whenLoaded('article'))
        ];
    }
}
