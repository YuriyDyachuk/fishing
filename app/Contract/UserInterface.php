<?php

declare(strict_types=1);

namespace App\Contract;

use App\Models\User;
use App\DataTransObject\UserDTO;

interface UserInterface
{
    public function create(UserDTO $DTO): User;

    public function getById(int $id): ?User;

    public function getByEmail(string $email): ?User;

    public function update(int $id, UserDTO $DTO): void;

    public function existsById(int $id): bool;

    public function existsByEmail(string $email): bool;

    public function changePassword(string $email, string $pass): void;
}