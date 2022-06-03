<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Services\Media\MediaService;
use App\Services\Admin\ReportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MediaReportController extends Controller
{
    private MediaService $mediaService;
    private ReportService $reportService;

    public function __construct(
        MediaService $mediaService,
        ReportService $reportService
    ){
        $this->mediaService = $mediaService;
        $this->reportService = $reportService;
    }

    public function destroy(int $id, string $uuid): RedirectResponse
    {
        if (!$this->reportService->exists($id) && !$this->mediaService->existsFile($id, $uuid)) {
            return redirect()->back()->with(['error' => 'Действие запрещенно!'])->withInput();
        }

        $this->mediaService->deleteMedia($uuid);

        return redirect()->back()->with(['success' => 'Фото успешно удаленно.'])->withInput();
    }

    public function sortable(Request $request): JsonResponse
    {
        if ($request->ajax() && $request->has('position')) {
            $this->mediaService->setPosition($request->input('position'));
        }

        return response()->json(['data' => 'Success'], 200);
    }
}
