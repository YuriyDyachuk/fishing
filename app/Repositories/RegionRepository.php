<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Region;

class RegionRepository extends AbstractRepository
{
    public function model(): string
    {
        return Region::class;
    }

    public function getName(): array
    {
        return $this->query()->pluck('name','id')->toArray();
    }
}