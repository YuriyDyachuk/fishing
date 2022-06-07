<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\SubscriberRepository;

class SubscriberService
{
    private SubscriberRepository $subscriberRepository;

    public function __construct(SubscriberRepository $subscriberRepository)
    {
        $this->subscriberRepository = $subscriberRepository;
    }

    public function destroyFollow(int $id, int $followId)
    {
        $this->subscriberRepository->destroyFollow($id, $followId);
    }

}