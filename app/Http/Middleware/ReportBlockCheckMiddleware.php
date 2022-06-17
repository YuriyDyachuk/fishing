<?php

namespace App\Http\Middleware;

use App\Models\Report;
use Closure;
use Illuminate\Http\Request;

class ReportBlockCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
//        $report = Report::query()->findOrFail((int) $request->id);
//
//        if ($report->blocking) {
//            return redirect()->route('admin.reports.index')->with(['error' => 'Action is blocked!'])->withInput();
//        }

        return $next($request);
    }
}
