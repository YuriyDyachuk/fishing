<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->ajax()) {
            $region = Region::query()->findOrFail($request->id);
        }

        return response()->json(['data' => $region, 'status' => 'success']);
    }
}
