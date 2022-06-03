<?php

declare(strict_types=1);

namespace App\Contract;

use App\DataTransObject\ReportSearchDTO;
use App\Models\Report;
use App\DataTransObject\ReportDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ReportInterface
{
    public function getAll(): LengthAwarePaginator;

    public function create(ReportDTO $DTO): Report;

    public function show(int $id): Report;

    public function getById(int $id): ?Report;

    public function getLast(): Collection;

    public function search(ReportSearchDTO $DTO): Collection;
}