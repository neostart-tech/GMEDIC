<?php

namespace App\Traits\Routing;

trait ModelsSlugKeyTrait
{
	public function getRouteKeyName(): string
	{
		return 'slug';
	}

	public function getSlugBaseKeyName(): string
	{
		return "nom";
	}

	public function hasSlugBaseKeyProvider(): bool
	{
		return true;
	}

	public function hasComplexSlug(): bool
	{
		return false;
	}
}
