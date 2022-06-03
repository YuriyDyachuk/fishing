<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\Report;
use App\DataTransObject\ReportDTO;
use App\Repositories\Admin\ReportRepository;
use Illuminate\Database\Eloquent\Collection;

class ReportService
{
    private ReportRepository $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function getAll(): Collection
    {
        return $this->reportRepository->getAll();
    }

    public function store(ReportDTO $DTO): Report
    {
        return $this->reportRepository->create($DTO);
    }

    public function findById(int $id): ?Report
    {
        return $this->reportRepository->findById($id);
    }

    public function update(ReportDTO $DTO, int $id): void
    {
        $this->reportRepository->update($DTO, $id);
    }

    public function delete(int $id): void
    {
        $this->reportRepository->delete($id);
    }

    public function notPublished(): Collection
    {
        return $this->reportRepository->notPublished();
    }

    public function exists(int $id): bool
    {
        return $this->reportRepository->exists($id);
    }

    public function count(): int
    {
        return $this->reportRepository->count();
    }
}