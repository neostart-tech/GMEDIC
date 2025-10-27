<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategorieRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          "id"=> $this->resource->id,
        "category_name"=> $this->getCategory(),
        "published"=> $this->resource->published,
        "created_at"=> $this->resource->created_at,
        "updated_at"=> $this->resource->updated_at,
        "image"=> $this->resource->image,
        "slug"=> $this->resource->slug,
        ];
    }
}
