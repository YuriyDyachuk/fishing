<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\RegionRepository;

class RegionService
{
    private RegionRepository $regionRepository;

    public function __construct(RegionRepository $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    public function getName(): array
    {
        return $this->regionRepository->getName();
    }
}