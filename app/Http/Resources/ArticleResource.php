<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategorieRessource;
use App\Http\Resources\SousCategorieResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'article_desc' => $this->article_desc,
            'article_image' => $this->article_image,
            'article_name' => $this->article_name,
            'published' => $this->published,
            'slug' => $this->slug,
            'categorie_id' => $this->categorie_id,
            'category' => new CategorieRessource($this->category),
            'SubCategory'=> new SousCategorieResource($this->subCategorie),
           

        ];
    }
}
