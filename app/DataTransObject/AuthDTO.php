<?php

declare(strict_types=1);

namespace App\DataTransObject;

use Spatie\DataTransferObject\DataTransferObject;

class AuthDTO extends DataTransferObject
{
    public string $name;

    public string $email;

    public string $phone;

    public string $password;
}