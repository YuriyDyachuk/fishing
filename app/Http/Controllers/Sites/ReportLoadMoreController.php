<?php

declare(strict_types=1);

namespace App\Http\Controllers\Sites;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\ReportService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ReportLoadMoreController extends Controller
{
    public function loadMore(Request $request, ReportService $reportService): JsonResponse
    {
        $reports = collect();
        if ($request->ajax()) {
            $reports = $reportService->getAll();
            foreach ($reports as $k=>$report) {
                $reports[$k]['avatar'] = $report->getFirstMediaUrl('gallery','small');
            }
        }

        return response()->json([
                    'data' => $reports->items(),
                    'page' => $reports->currentPage(),
                    'pageOff' => $reports->lastPage() === $reports->currentPage() + 1 ? true : false
                ]);
    }

    public function loadMoreReport(Request $request, ReportService $reportService): JsonResponse
    {
        $reports = collect();
        if ($request->ajax()) {
            $reports = $reportService->getAllUser((int) $request->id);
            foreach ($reports as $k=>$report) {
                $reports[$k]['avatar'] = $report->getFirstMediaUrl('gallery','thumb');
                $reports[$k]['commentCount'] = $report->comments()->count();
            }
        }

        return response()->json([
            'data' => $reports->items(),
            'page' => $reports->currentPage(),
            'pageOff' => $reports->lastPage() === $reports->currentPage() ? true : false
        ]);
    }

    public function loadMoreFollowers(Request $request, UserService $userService): JsonResponse
    {
        $followers = collect();
        if ($request->ajax()) {
            $followers = $userService->getAllFollowerUser((int) $request->id);
            foreach ($followers as $k=>$follower) {
                $followers[$k]['avatar'] = $follower->media('media')->exists()
                                            ? $follower->getFirstMediaUrl('media','small')
                                            : asset('images/user/user-128.png');
            }
        }

        return response()->json([
            'data' => $followers->items(),
            'page' => $followers->currentPage(),
            'pageOff' => $followers->lastPage() === $followers->currentPage() ? true : false
        ]);
    }
}
