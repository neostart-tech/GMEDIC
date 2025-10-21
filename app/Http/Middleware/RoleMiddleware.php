<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
	public function handle(Request $request, Closure $next): Response
	{
		if ($request->user()->role_id !== 1)
			abort(Response::HTTP_UNAUTHORIZED);

		return $next($request);
	}
}
