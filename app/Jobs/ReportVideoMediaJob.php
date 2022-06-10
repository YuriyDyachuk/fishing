<?php

declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use FFMpeg\Filters\Video\VideoFilters;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ReportVideoMediaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Model $model;

    private string $path;

    public function __construct(Model $model, string $path)
    {
        $this->model = $model;
        $this->path = $path;
    }

    public function handle()
    {
        $fileName = Str::random(30) . '.mp4';
        $watermarkPath = public_path('watermark.png');
        $file = FFMpeg::fromDisk('public')
            ->open($this->path)
            ->addFilter(function (VideoFilters $filters) use ($watermarkPath) {
//                $filters->resize(new \FFMpeg\Coordinate\Dimension(854, 480));
                $filters->watermark($watermarkPath, [
                    'position' => 'relative',
                    'top' => 10,
                    'left' => 10,
                    'width' => 20,
                    'height' => 22,
                ]);
            })
            ->export()
            ->toDisk('public')
            ->inFormat(new \FFMpeg\Format\Video\X264())
            ->save('tmp/' . $this->model->id . "/$fileName");

        $this->model->addMedia(storage_path('app/public/tmp/' . $this->model->id . "/$fileName"))->toMediaCollection('media', 'media');
        Storage::disk('public')->delete('tmp/' . $this->model->id);
        Storage::disk('public')->delete($file->getPathfile());

        /* Delete this empty folder for recipeID */
        /* Source code */
    }
}