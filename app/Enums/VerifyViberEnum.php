<?php

declare(strict_types=1);

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self NOT_VERIFY()
 * @method static self SUCCESS_VERIFY()
 */
class VerifyViberEnum extends Enum
{
    public static function values(): array
    {
        return [
            'NOT_VERIFY' => 0,
            'SUCCESS_VERIFY' => 1
        ];
    }
}