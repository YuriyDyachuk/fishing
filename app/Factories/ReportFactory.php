<?php

declare(strict_types=1);

namespace App\Factories;

use App\Enums\RoleEnum;
use Illuminate\Http\Request;
use App\DataTransObject\ReportDTO;

class ReportFactory
{
    public function create(Request $request): ReportDTO
    {
        return new ReportDTO([
            'user_id' => $request->user()->id,
            'region_id' => $request->has('regionId') ? (int) $request->input('regionId') : null,
            'publish' => in_array($request->user()->role, RoleEnum::getRole()) ? 1 : 0,
            'lat' => trim($request->input('lat')),
            'lng' => trim($request->input('lng')),
            'description' => trim(strip_tags($request->input('description')))
        ]);
    }
}