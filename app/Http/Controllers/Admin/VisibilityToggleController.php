<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\DB;
use Throwable;

class VisibilityToggleController extends Controller
{
	public function __invoke(Request $request): Response|ResponseFactory
	{
		try {
			$query = DB::table($request->get('table'))->where("slug", $request->get('slug'));
			$model = $query->first();
			if (!$model)
				return __404();

			$query->update([
				"published" => !$model->published,
			]);

		} catch (Throwable $th) {
			return __500($th->getMessage());
		}
		return __200('', [
			'new_class' => 'text-white fas fa-lock' . (!$model->published ? '-open' : ''),
		]);
	}
}
