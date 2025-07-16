<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
  public function handle($request, Closure $next, $role)
  {
    $user = auth()->user();

    if (!$user || !$user->hasRole($role)) {
      return response()->json([
        'message' => 'Unauthorized',
        'status' => 401
      ], 401);
    }

    return $next($request);
  }
}
