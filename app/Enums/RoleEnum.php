<?php

declare(strict_types=1);

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self ADMIN()
 * @method static self MODERATOR()
 * @method static self CUSTOMER()
 */
class RoleEnum extends Enum
{
    public static function values(): array
    {
        return [
            'ADMIN' => 1,
            'MODERATOR' => 2,
            'CUSTOMER' => 3
        ];
    }

    public static function getRole(): array
    {
        return [
            self::ADMIN()->value,
            self::MODERATOR()->value
        ];
    }
}