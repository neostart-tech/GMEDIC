<?php

namespace App\Models;

use App\Traits\Routing\{GenerateUniqueSlugTrait, ModelsSlugKeyTrait};
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
	use ModelsSlugKeyTrait, GenerateUniqueSlugTrait;

	public function hasSlugBaseKeyProvider(): bool
	{
		return false;
	}

//	public static function boot(): void
//	{
//		parent::boot();
//		static::creating(fn($model) => $model->slug = uniqid());
//	}

	protected $fillable = [
		'slide_image',
		'slider_desc',
		'published',
	];
}
