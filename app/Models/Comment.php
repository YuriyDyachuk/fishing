<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [];

    ############################## [RELATION METHOD] ##############################

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    ############################## [CUSTOM METHOD] ##############################

    public function getCustomDateAttribute(): string
    {
        return Carbon::parse($this->created_at)->format('m.d.Y H:i');
    }
}
