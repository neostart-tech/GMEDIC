<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'blog_title' => $this->blog_title,
            'blog_description' => $this->blog_description,
            'blog_image' => $this->blog_image,
            'date_publication' => $this->created_at->format('d M Y')
        ];
    }
}
