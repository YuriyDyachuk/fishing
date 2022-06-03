<?php

declare(strict_types=1);

namespace App\Http\Controllers\Sites;

use App\Factories\ReportSearchFactory;
use App\Services\ReportService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private ReportService $reportService;
    private ReportSearchFactory $searchFactory;

    public function __construct(
        ReportService $reportService,
        ReportSearchFactory $searchFactory
    ){
        $this->reportService = $reportService;
        $this->searchFactory = $searchFactory;
    }

    public function index()
    {
        $reports = $this->reportService->getWithLastTen();

        return view('sites.layouts.partials.content', [
            'reports' => $reports
        ]);
    }

    public function search(Request $request): JsonResponse
    {
        $newDate = [];
        $reports = collect();

        if (!is_null($request->input('dateRange'))) {
            $newDate = generateStringDate($request->input('dateRange'));
        }

        if ($request->ajax()) {
            $DTO = $this->searchFactory->create($request, $newDate);
            $reports = $this->reportService->search($DTO);
        }

        return response()->json(['data' => $reports, 'status' => 'Success']);
    }
}
