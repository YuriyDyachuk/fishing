<?php

declare(strict_types=1);

namespace App\Http\Controllers\Sites\Report;

use App\Services\RegionService;
use App\Services\ReportService;
use App\Factories\ReportFactory;
use App\Http\Controllers\Controller;
use App\Services\Media\MediaService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Report\ReportRequest;

class ReportingController extends Controller
{
    private MediaService $mediaService;
    private RegionService $regionService;
    private ReportService $reportService;
    private ReportFactory $reportFactory;

    public function __construct(
        MediaService $mediaService,
        RegionService $regionService,
        ReportService $reportService,
        ReportFactory $reportFactory
    ){
        $this->mediaService = $mediaService;
        $this->regionService = $regionService;
        $this->reportService = $reportService;
        $this->reportFactory = $reportFactory;
    }

    public function index()
    {
        return view('sites.reports.index', ['reports' => $this->reportService->getAll()]);
    }

    public function create()
    {
        return view('sites.reports.create', ['regions' => $this->regionService->getName()]);
    }

    public function store(ReportRequest $request): RedirectResponse
    {
        \DB::beginTransaction();
        try {
            $DTO = $this->reportFactory->create($request);
            $report = $this->reportService->store($DTO);
            $this->mediaService->storeMedia($report, $request->file('media'));
            \DB::commit();

        }catch (\Throwable $exception) {
            \DB::rollBack();

            return redirect()->back()->with(['error' => $exception->getMessage()])->withInput();
        }

        return redirect()->route('reporting.index')->with(['success' => 'Отчет успешно создан.'])->withInput();
    }

    public function show(int $id)
    {
        $report = $this->reportService->findById($id);

        return view('sites.reports.show', [
            'report' => $report
        ]);
    }
}