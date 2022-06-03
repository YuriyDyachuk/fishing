<?php

declare(strict_types=1);

namespace App\Repositories\Admin;

use App\Models\Report;
use App\DataTransObject\ReportDTO;
use App\Contract\Admin\ReportInterface;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

class ReportRepository extends AbstractRepository implements ReportInterface
{
    public function model(): string
    {
        return Report::class;
    }

    public function getAll(): Collection
    {
        return $this->query()
                    ->orderBy('id','DESC')
                    ->get();
    }

    public function create(ReportDTO $DTO): Report
    {
        return $this->query()
                    ->create($DTO->toArray())
                    ->refresh();
    }

    public function findById(int $id): Report
    {
        return $this->query()->find($id);
    }

    public function update(ReportDTO $DTO, int $id): void
    {
        $this->query()
             ->where('id', $id)
             ->update([
                 'description' => $DTO->description,
                 'publish' => $DTO->publish,
                 'lat' => $DTO->lat,
                 'lng' => $DTO->lng,
                 'region_id' => $DTO->region_id,
                 'blocking' => false
             ]);
    }

    public function delete(int $id): void
    {
        $this->query()
             ->where('id', $id)
             ->delete();
    }

    public function notPublished(): Collection
    {
        return $this->query()->where('publish', false)->get();
    }

    public function exists(int $id): bool
    {
        return $this->query()->where('id', $id)->exists();
    }

    public function count(): int
    {
        return $this->query()->where('publish',true)->count();
    }
}