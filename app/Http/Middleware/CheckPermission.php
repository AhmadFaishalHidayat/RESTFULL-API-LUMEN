<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
{
  public function handle($request, Closure $next, $permission)
  {
    $user = auth()->user();
    if (!$user || $user->hasPermission($permission)) {
      return  response()->json([
        'message' => 'Forbidden',
        'status' => 403
      ], 403);
    }
    return $next($request);
  }
}
