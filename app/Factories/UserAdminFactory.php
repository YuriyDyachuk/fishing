<?php

declare(strict_types=1);

namespace App\Factories;

use App\VO\UserAdminVO;
use Illuminate\Http\Request;

class UserAdminFactory
{
    public function create(Request $request): UserAdminVO
    {
        return new UserAdminVO(
            $request->has('role') ? (int)$request->input('role') : null,
            $request->has('ban') ? true : false
        );
    }
}