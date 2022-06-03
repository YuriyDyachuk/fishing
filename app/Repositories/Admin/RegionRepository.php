<?php

declare(strict_types=1);

namespace App\Repositories\Admin;

use App\Models\Region;
use App\Contract\Admin\RegionInterface;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

class RegionRepository extends AbstractRepository implements RegionInterface
{
    public function model(): string
    {
        return Region::class;
    }

    public function getAll(): Collection
    {
        return $this->query()->get();
    }

    public function getName(): array
    {
        return $this->query()->select('id','name','lat','lng')->get()->toArray();
    }

    public function delete(int $id): void
    {
        $this->query()
             ->where('id', $id)
             ->delete();
    }
}