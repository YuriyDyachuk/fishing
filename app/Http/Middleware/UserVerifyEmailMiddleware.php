<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class UserVerifyEmailMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::query()->where(['email' => $request->email])->firstOrFail();

        if ($user->verify) {
            return redirect()->route('main')->with(['error' => 'Ваша почта верифицирована.'])->withInput();
        }

        return $next($request);
    }
}
