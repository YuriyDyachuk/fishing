<?php

declare(strict_types=1);

namespace App\Factories;

use Illuminate\Http\Request;
use App\DataTransObject\ReportDTO;

class ReportFactory
{
    public function create(Request $request): ReportDTO
    {
        return new ReportDTO([
            'user_id' => auth()->id(),
            'region_id' => $request->has('regionId') ? (int) $request->input('regionId') : null,
            'publish' => $request->has('status') ? 1 : 0,
            'lat' => trim($request->input('lat')),
            'lng' => trim($request->input('lng')),
            'description' => trim($request->input('description'))
        ]);
    }
}