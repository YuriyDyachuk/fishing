<?php

declare(strict_types=1);

namespace App\Factories;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\DataTransObject\UserDTO;

class UserFactory
{
    public function store(Request $request): UserDTO
    {
        return new UserDTO([
            'gender' => $request->has('gender') ? (int) $request->input('gender') : null,
            'bio' => !is_null($request->input('bio')) ? $request->input('bio') : null,
            'city' => !is_null($request->input('city')) ? $request->input('city') : auth()->user()->city,
            'name' => trim($request->input('name')),
            'email' => trim($request->input('email')),
            'phone' => trim($request->input('phone')),
            'password' => bcrypt($request->input('password')),
            'birthday' => !is_null($request->input('birthday')) ? Carbon::parse($request->input('birthday')) : auth()->user()->birthday
        ]);
    }
}