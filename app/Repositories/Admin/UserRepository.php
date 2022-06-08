<?php

declare(strict_types=1);

namespace App\Repositories\Admin;

use App\Enums\RoleEnum;
use App\Models\User;
use App\DataTransObject\UserDTO;
use App\Contract\Admin\UserInterface;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends AbstractRepository implements UserInterface
{
    public function model(): string
    {
        return User::class;
    }

    public function getAll(): Collection
    {
        return $this->query()
                    ->where('role', RoleEnum::CUSTOMER()->value)
                    ->orderBy('id', 'DESC')
                    ->get();
    }

    public function create(UserDTO $DTO): User
    {
        return $this->query()
                    ->create($DTO->toArray())
                    ->refresh();
    }

    public function findById(int $id): User
    {
        return $this->query()->with(['reports', 'follows'])->findOrFail($id);
    }

    public function update(int $id, UserDTO $DTO): void
    {
        $this->query()
             ->where('id', $id)
             ->update($DTO->toArray());
    }

    public function delete(int $id): void
    {
        $this->query()
             ->where('id', $id)
             ->delete();
    }

    public function moderationUser(): Collection
    {
        return $this->query()
                    ->whereIn('role', RoleEnum::getRole())
                    ->get()
                    ->filter(function ($user) {
                        return $user->id !== request()->user()->id;
                    });
    }

    public function existsById(int $id): bool
    {
        return $this->query()
                    ->where('id', $id)
                    ->exists();
    }

    public function changePassword(string $email, string $pass): void
    {
        $this->query()
             ->where('email', $email)
             ->update(['password' => $pass]);
    }
}