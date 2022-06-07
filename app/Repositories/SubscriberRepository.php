<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Follow;

class SubscriberRepository extends AbstractRepository
{
    public function model(): string
    {
        return Follow::class;
    }

    public function destroyFollow(int $id, int $followId): void
    {
        $this->query()->where(['follow_id' => $id, 'follower_id' => $followId])->delete();
        $this->query()->where(['follow_id' => $followId, 'follower_id' => $id, ])->delete();
    }
}