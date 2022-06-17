<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BannedUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->ban) {
            return redirect()->route('main');
        }

        return $next($request);
    }
}
