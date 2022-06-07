<?php

declare(strict_types=1);

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Report;
use App\Contract\ReportInterface;
use App\DataTransObject\ReportDTO;
use App\DataTransObject\ReportSearchDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ReportRepository extends AbstractRepository implements ReportInterface
{
    public function model(): string
    {
        return Report::class;
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->query()
                    ->with('user')
                    ->where('publish', true)
                    ->orderBy('id','DESC')
                    ->paginate($this->perPage);
    }

    public function create(ReportDTO $DTO): Report
    {
        return $this->query()
                    ->create($DTO->toArray())
                    ->refresh();
    }

    public function show(int $id): Report
    {
        return $this->query()
                    ->where('id', $id)
                    ->first();
    }

    public function getById(int $id): ?Report
    {
        return $this->query()
                    ->findOrFail($id);
    }

    public function getLast(): Collection
    {
        return $this->query()
                    ->with(['user','comments'])
                    ->where('publish',true)
                    ->orderByDesc('created_at')
                    ->limit(Report::LIMIT_COUNT)
                    ->get();
    }

    public function search(ReportSearchDTO $DTO): Collection
    {
        return $this->query()
                    ->select('id', 'lat', 'lng', 'region_id', 'user_id', 'created_at')
                    ->with('user', function($query) {
                        $query->select('id', 'name');
                    })
                    ->when($DTO->region_id !== 0, function ($q) use ($DTO) {
                        return $q->where('region_id', $DTO->region_id);
                    })
                    ->when($DTO->date, function ($q) use ($DTO) {
                        return $q->whereDate('created_at', '=', $DTO->date);
                    })
                    ->when($DTO->rangeTo && $DTO->rangeFrom, function ($q) use ($DTO) {
                        return $q->whereDate('created_at','>=', $DTO->rangeTo)->whereDate('created_at','<=', $DTO->rangeFrom);
                    })
                    ->get();
    }

    public function getAllUser(int $id)
    {
        return $this->query()
                    ->with(['comments'])
                    ->where('user_id', $id)
                    ->paginate($this->perPage);
    }
}