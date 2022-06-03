<?php

declare(strict_types=1);

namespace App\Contract\Admin;

use App\Models\Report;
use App\DataTransObject\ReportDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ReportInterface
{
    public function getAll(): Collection;

    public function create(ReportDTO $DTO): Report;

    public function findById(int $id): Report;

    public function update(ReportDTO $DTO, int $id): void;

    public function delete(int $id): void;

    public function notPublished(): Collection;

    public function exists(int $id): bool;

    public function count(): int;
}