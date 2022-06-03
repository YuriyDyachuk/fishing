<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Report;

use App\Services\ReportService;
use App\Http\Controllers\Controller;

class StatusReportController extends Controller
{
    private ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function moderation(int $id)
    {
        if (!$this->reportService->findById($id)) {
            return back()->with(['error' => 'Отчет не найден!'])->withInput();
        }

        $this->reportService->changeModeration($id);

        return redirect()->route('')->with(['success' => 'Статус отчета успешно изменен. Отчет опубликован.'])->withInput();
    }
}
