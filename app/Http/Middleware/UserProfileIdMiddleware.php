<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserProfileIdMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::id() !== (int) $request->id) {
            return redirect()->back()->withErrors(['error' => 'Действие запрещенно.']);
        }

        return $next($request);
    }
}
