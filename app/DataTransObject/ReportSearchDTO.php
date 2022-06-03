<?php

declare(strict_types=1);

namespace App\DataTransObject;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class ReportSearchDTO extends DataTransferObject
{
    public ?int $region_id;

    public ?Carbon $date;

    public ?Carbon $rangeTo;

    public ?Carbon $rangeFrom;
}