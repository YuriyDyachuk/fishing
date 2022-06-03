<?php

declare(strict_types=1);

namespace App\VO;

class UserAdminVO
{
    public ?int $role;
    public ?bool $ban;

    public function __construct(
        ?int $role,
        ?bool $ban
    ){
        $this->role = $role;
        $this->ban = $ban;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function getBan(): ?bool
    {
        return $this->ban;
    }

    public function toArray(): array
    {
        return [
            'role' => $this->getRole(),
            'ban' => $this->getBan()
        ];
    }
}