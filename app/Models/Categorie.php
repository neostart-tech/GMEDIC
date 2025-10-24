<?php

namespace App\Models;

use App\Traits\Routing\{GenerateUniqueSlugTrait, ModelsSlugKeyTrait};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;


/**
 * @method static self create(array $attributes)
 * @property Collection<array-key, Article> $articles
 */
class Categorie extends Model
{
	use ModelsSlugKeyTrait, GenerateUniqueSlugTrait,HasTranslations;

	public function getSlugBaseKeyName(): string
	{
		return "category_name";
	}

	public $translatable = ['category_name'];


	public function hasComplexSlug(): bool
	{
		return true;
	}

	protected $fillable = [
		'category_name',
		'published'
	];

	/**
	 * Le Relationship en une catégorie et ses articles
	 */
	public function articles(): HasMany
	{
		return $this->hasMany(Article::class, 'categorie_id', 'id');
	}
}
