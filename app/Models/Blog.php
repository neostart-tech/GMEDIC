<?php

namespace App\Models;

use App\Traits\Routing\{GenerateUniqueSlugTrait, ModelsSlugKeyTrait};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use ModelsSlugKeyTrait, GenerateUniqueSlugTrait;

    protected $fillable = [
        'blog_title',
        'blog_description',
        'blog_image',
        'published',
    ];
    public function getImageUrlAttribute()
    {
        return asset($this->blog_image);
    }
    public function getSlugBaseKeyName(): string
    {
        return 'blog_title';
    }
}
