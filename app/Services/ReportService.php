<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransObject\ReportSearchDTO;
use App\Models\Report;
use App\DataTransObject\ReportDTO;
use App\Repositories\ReportRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ReportService
{
    private ReportRepository $reportRepository;

    public function __construct(
        ReportRepository $reportRepository
    ){
        $this->reportRepository = $reportRepository;
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->reportRepository->getAll();
    }

    public function store(ReportDTO $DTO): Report
    {
        return $this->reportRepository->create($DTO);
    }

    public function findById(int $id): ?Report
    {
        return $this->reportRepository->getById($id);
    }

    public function getWithLastTen(): Collection
    {
        return $this->reportRepository->getLast();
    }

    public function search(ReportSearchDTO $DTO): Collection
    {
        return $this->reportRepository->search($DTO);
    }

    public function getAllUser(int $id)
    {
        return $this->reportRepository->getAllUser($id);
    }
}