<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $guarded = [];

    protected $casts = [];

    ############################## [RELATION METHOD] ##############################

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
