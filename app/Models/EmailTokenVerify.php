<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailTokenVerify extends Model
{
    use HasFactory;

    protected $table = 'email_token_verify';

    protected $guarded = [];

    ############################## [RELATION METHOD] ##############################
}