<?php

declare(strict_types=1);

namespace App\Contract\Admin;

use App\Models\User;
use App\DataTransObject\UserDTO;
use Illuminate\Database\Eloquent\Collection;

interface UserInterface
{
    public function getAll(): Collection;

    public function create(UserDTO $DTO): User;

    public function findById(int $id): User;

    public function update(int $id, UserDTO $DTO): void;

    public function delete(int $id): void;

    public function moderationUser(): Collection;

    public function existsById(int $id): bool;

    public function changePassword(string $email, string $pass): void;
}