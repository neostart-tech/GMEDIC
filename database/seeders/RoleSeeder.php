<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
	public function run(): void
	{
		Role::query()->create([
			'label' => 'Super Administrateur'
		]);

		Role::query()->create([
			'label' => 'Administrateur'
		]);
	}
}
