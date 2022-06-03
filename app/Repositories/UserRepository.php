<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Contract\UserInterface;
use App\DataTransObject\UserDTO;

class UserRepository extends AbstractRepository implements UserInterface
{
    public function model(): string
    {
        return User::class;
    }

    public function create(UserDTO $DTO): User
    {
        return $this->query()
                    ->create($DTO->toArray())
                    ->refresh();
    }

    public function getById(int $id): ?User
    {
        return $this->query()->with(['reports', 'followersConfirm'])->find($id);
    }

    public function getByEmail(string $email): ?User
    {
        return $this->query()->where('email', $email)->first();
    }

    public function update(int $id, UserDTO $DTO): void
    {
        $this->query()
             ->where('id', $id)
             ->update($DTO->toArray());
    }

    public function existsById(int $id): bool
    {
        return $this->query()
                    ->where('id', $id)
                    ->exists();
    }

    public function existsByEmail(string $email): bool
    {
        return $this->query()
                    ->where('email', $email)
                    ->exists();
    }

    public function changePassword(string $email, string $pass): void
    {
        $this->query()
             ->where('email', $email)
             ->update(['password' => $pass]);
    }
}