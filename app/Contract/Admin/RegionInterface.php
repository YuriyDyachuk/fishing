<?php

declare(strict_types=1);

namespace App\Contract\Admin;

use Illuminate\Database\Eloquent\Collection;

interface RegionInterface
{
    public function getAll(): Collection;

    public function getName(): array;

    public function delete(int $id): void;
}