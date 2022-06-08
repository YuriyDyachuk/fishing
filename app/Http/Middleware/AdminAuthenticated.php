<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if(\Auth::check())
        {
            // if user is not admin take him to his dashboard
            if (\request()->user()->isUser()) {
                return redirect(route('main'));
            }

            // allow admin to proceed with request
            else if (\request()->user()->isAdmin() || \request()->user()->isModerator()) {
                if (\request()->user()->isAdminBanned()) {
                    return redirect(route('main'));
                }

                return $next($request);
            }
        }

        abort(404);  // for other user throw 404 error
    }
}
