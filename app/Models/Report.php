<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use App\Enums\MediaEnum;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Report extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'lat',
        'lng',
        'name',
        'publish',
        'user_id',
        'blocking',
        'region_id',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'blocking' => 'boolean',
    ];

    ############################## [RELATION METHOD] ##############################

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function region(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')
                    ->whereNull('parent_id');
    }

    ############################## [CUSTOM METHOD] ##############################

    public function getCustomDateAttribute(): string
    {
        return Carbon::parse($this->created_at)->format('d.m.Y');
    }

    //================================== [CUSTOM METHODS MEDIA LIBRARY] ==================================#

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('small')
                    ->width(MediaEnum::width()->value)
                    ->height(MediaEnum::height()->value)
                    ->watermark(public_path('watermark_fix.png'))
                    ->watermarkPosition(Manipulations::POSITION_TOP_LEFT)
                    ->watermarkWidth(50)
                    ->watermarkHeight(50)
                    ->watermarkPadding(10,10)
                    ->watermarkOpacity(80);
            });
    }
}