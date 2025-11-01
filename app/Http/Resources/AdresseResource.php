<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class AdresseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
        'id'=>$this->resource->id,
        'user_id'=>$this->resource->user_id,
        'etablissement'=>$this->resource->etablissement,
        'adresse'=>$this->resource->adresse,
        'ville'=>$this->resource->ville,
        'code_postal'=>$this->resource->code_postal,
        'telephone'=>$this->resource->telephone,
        'notes_livraison'=>$this->resource->notes_livraison,
        "user"=>new UserResource($this->whenLoaded('user'))
        ];
    }
}
