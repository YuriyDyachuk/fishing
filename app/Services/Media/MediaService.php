<?php

declare(strict_types=1);

namespace App\Services\Media;

use Illuminate\Support\Str;
use App\Jobs\ReportVideoMediaJob;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Media\MediaRepository;

class MediaService
{
    private MediaRepository $mediaRepository;

    public function __construct(MediaRepository $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }

    public function storeMedia(Model $model, array $files): void
    {
        $this->mediaRepository->store($model, $files['gallery'], 'gallery');

        if (isset($files['video'])) {
            foreach ($files['video'] as $media) {
                $fileName = Str::random(30) . '.mp4';
                $file = Storage::disk('public')->putFileAs('tmp', $media, $fileName);
                ReportVideoMediaJob::dispatch($model, $file);
            }
        }
    }

    public function setPosition(array $positions)
    {
        $this->mediaRepository->update($positions);
    }

    public function deleteMedia(string $uuid): void
    {
        $this->mediaRepository->destroy($uuid);
    }

    public function deleteMediaCollection(Model $model): void
    {
        $model->getMedia('media')->map(function ($media) {
            $media->delete();
        });
    }

    public function existsFile(int $id, string $uuid): bool
    {
        return $this->mediaRepository->existsFile($id, $uuid);
    }
}