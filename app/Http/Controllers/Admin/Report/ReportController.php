<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Report;

use App\Enums\MediaEnum;
use App\Factories\ReportFactory;
use App\Http\Controllers\Controller;
use App\Services\Admin\RegionService;
use App\Services\Media\MediaService;
use App\Services\Admin\ReportService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Report\ReportRequest;
use App\Http\Requests\Report\ReportUpdateRequest;

class ReportController extends Controller
{
    private MediaService $mediaService;
    private ReportService $reportService;
    private ReportFactory $reportFactory;
    private RegionService $regionService;

    public function __construct(
        MediaService $mediaService,
        ReportService $reportService,
        ReportFactory $reportFactory,
        RegionService $regionService
    ){
        $this->mediaService = $mediaService;
        $this->reportService = $reportService;
        $this->reportFactory = $reportFactory;
        $this->regionService = $regionService;
    }

    public function index()
    {
        $reports = $this->reportService->getAll();

        return view('admin.reports.index', ['reports' => $reports]);
    }

    public function create()
    {
        return view('admin.reports.create', ['regions' => $this->regionService->getName()]);
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

        return redirect()->route('admin.reports.index')->with(['success' => 'Отчет успешно создан.'])->withInput();
    }

    public function show(int $id)
    {
        if (!$this->reportService->exists($id)) {
            return redirect()->back()->with(['error' => 'Отчет не найден!'])->withInput();
        }

        return view('admin.reports.show', [
            'report' => $this->reportService->findById($id)
        ]);
    }

    public function edit(int $id)
    {
        if (!$this->reportService->exists($id)) {
            return redirect()->back()->with(['error' => 'Отчет не найден!'])->withInput();
        }

        return view('admin.reports.edit', [
                    'report' => $this->reportService->findById($id),
                    'regions' => $this->regionService->getName()
                ]);
    }

    public function update(ReportUpdateRequest $request, int $id): RedirectResponse
    {
        if (!$this->reportService->exists($id)) {
            return redirect()->back()->with(['error' => 'Отчет не найден!'])->withInput();
        }
        $DTO = $this->reportFactory->create($request);
        $this->reportService->update($DTO, $id);

        return redirect()->route('admin.reports.index')->with(['success' => 'Отчет успешно опубликован.'])->withInput();
    }

    public function destroy(int $id): RedirectResponse
    {
        \DB::beginTransaction();
        try {
            $report = $this->reportService->findById($id);
            $this->mediaService->deleteMediaCollection($report);
            $this->reportService->delete($id);
            \DB::commit();

        }catch (\Throwable $exception) {
            \DB::rollBack();

            return redirect()->back()->with(['error' => $exception->getMessage()])->withInput();
        }

        return redirect()->back()->with(['success' => 'Отчет успешно удален.'])->withInput();
    }

    public function published()
    {
        return view('admin.reports.not-published', [
                    'reports' => $this->reportService->notPublished(),
                    'regions' => $this->regionService->getName()
                ]);
    }
}