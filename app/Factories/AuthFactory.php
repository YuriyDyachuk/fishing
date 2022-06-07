<?php

declare(strict_types=1);

namespace App\Factories;

use Illuminate\Http\Request;
use App\DataTransObject\AuthDTO;

class AuthFactory
{
    public function store(Request $request): AuthDTO
    {
        return new AuthDTO([
            'name' => trim(strip_tags($request->input('name'))),
            'email' => trim(strip_tags($request->input('email'))),
            'phone' => trim(strip_tags($request->input('phone'))),
            'password' => bcrypt($request->input('password'))
        ]);
    }
}