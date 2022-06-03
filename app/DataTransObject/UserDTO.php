<?php

declare(strict_types=1);

namespace App\DataTransObject;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject
{
    public ?int $gender;

    public ?string $bio;

    public ?string $city;

    public string $name;

    public string $email;

    public string $phone;

    public ?string $password;

    public ?Carbon $birthday;
}