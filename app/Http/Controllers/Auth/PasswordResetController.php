<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class PasswordResetController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function customPassReset()
    {
        return view('sites.auth.password_reset');
    }

    public function passwordReset(Request $request): RedirectResponse
    {
        if (!$this->userService->existsByEmail($request->input('email'))) {
            return redirect()->back()->with(['error' => 'Почта указана неверно. Попробуйте еще раз!'])->withInput();
        }

        $this->userService->resetPassword($request->input('email'), bcrypt($request->input('password')));

        return redirect()->route('login')->with(['success' => 'Пароль успешно изменен.'])->withInput();
    }
}