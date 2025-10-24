<?php

namespace App\Models;

use App\Traits\Routing\{GenerateUniqueSlugTrait, ModelsSlugKeyTrait};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;



class Article extends Model
{
    use GenerateUniqueSlugTrait, ModelsSlugKeyTrait,HasTranslations;

    protected $fillable = [
        'article_name',
        'article_desc',
        'article_image',
        'published',
        'categorie_id',

    ];

        public $translatable = ['article_name', 'article_desc'];

    public function getImageUrlAttribute()
    {
        return asset($this->article_image);
    }

    
    public function getSlugBaseKeyName(): string
    {
        return 'article_name';
    }


    public function getTitle()
    {
        return $this->getTranslation('article_name', app()->getLocale());
    }

   
    public function getDescription()
    {
        return $this->getTranslation('article_desc', app()->getLocale());
    }

    /**
     * Obtient la catégorie à laquelle appartient cet article.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'categorie_id', 'id');
    }
}
