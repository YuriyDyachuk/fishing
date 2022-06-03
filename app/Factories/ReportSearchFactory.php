<?php

declare(strict_types=1);

namespace App\Factories;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\DataTransObject\ReportSearchDTO;

class ReportSearchFactory
{
    public function create(Request $request, ?array $data): ReportSearchDTO
    {
        return new ReportSearchDTO([
            'region_id' => $request->has('regionId') ? (int) $request->input('regionId') : null,
            'date' => !is_null($request->input('date')) ? $this->generateDate($request->input('date')) : null,
            'rangeTo' => !empty($data) ? $this->generateDate(head($data)) : null,
            'rangeFrom' => !empty($data) ? $this->generateDate(last($data)) : null,
        ]);
    }

    private function generateDate(?string $value): ?Carbon
    {
        return Carbon::parse($value);
    }
}