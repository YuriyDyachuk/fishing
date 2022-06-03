<?php

declare(strict_types=1);

namespace App\DataTransObject;

use Spatie\DataTransferObject\DataTransferObject;

class ReportDTO extends DataTransferObject
{
    public string $lat;

    public string $lng;

    public ?int $publish;

    public int $user_id;

    public ?int $region_id;

    public string $description;

    public ?int $blocking;
}