<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Admin\ReportService;

class AdminController extends Controller
{
    private ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        return view('admin.layouts.main', [
            'reportCount' => $this->reportService->count(),
            'publishReportCount' => Report::query()->where('publish', false)->count(),
            'userCount' => User::query()->count()
        ]);
    }
}
