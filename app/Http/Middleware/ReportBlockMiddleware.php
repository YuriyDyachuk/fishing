<?php

namespace App\Http\Middleware;

use App\Models\Report;
use Closure;
use Illuminate\Http\Request;

class ReportBlockMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        Report::query()->where(['id' => (int) $request->id])->update(['blocking' => true]);

        return $next($request);
    }
}
