<?php

declare(strict_types=1);

namespace App\Repositories\Media;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\AbstractRepository;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaRepository extends AbstractRepository
{
    public function model(): string
    {
        return Media::class;
    }

    public function store(Model $model, array $medias, string $type): void
    {
        foreach ($medias as $k=>$media) {
            $newPosition = $this->setKeyPositionMedia($model, $type);
            $model->addMedia($media)
                  ->withCustomProperties(['position' => $k + $newPosition])
                  ->toMediaCollection($type, $type);
        }
    }

    public function update(array $positions)
    {
        foreach ($positions as $key => $position) {
            $mediaItem = $this->query()->where(['id' => $key])->first();
            $mediaItem->setCustomProperty('position', (int) $position); // adds a new custom property or updates an existing one
            $mediaItem->save();
        }
    }

    public function destroy(string $uuid): void
    {
        $media = $this->query()->where('uuid', $uuid)->first();
        $media->delete();
    }

    public function existsFile(int $modelId, string $uuid): bool
    {
        return $this->query()
                    ->where(['uuid' => $uuid, 'model_id' => $modelId])
                    ->exists();
    }

    public function setKeyPositionMedia(Model $model, string $type): int
    {
        if ($model->getMedia($type)->count() > 0) {
            $lastPosition = $model->getMedia($type)->sortByDesc('custom_properties.position')->first();

            return $lastPosition->custom_properties['position'] + 1;
        }

        return 1;
    }
}