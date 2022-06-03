<?php

declare(strict_types=1);

namespace App\Factories;

use App\VO\MediaVO;

class MediaFactory
{
    public function create(array $media): MediaVO
    {
        return new MediaVO($media);
    }
}