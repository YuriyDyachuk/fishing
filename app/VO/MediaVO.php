<?php

declare(strict_types=1);

namespace App\VO;

class MediaVO
{
    /**
     * @var array
     */
    private array $media;

    public function __construct(array $media)
    {
        $this->media = $media;
    }

    public function getMedia(): array
    {
        return $this->media;
    }
}