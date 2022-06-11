<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function verify()
    {
        return view('sites.verify.index');
    }

    public function verifyEmail()
    {
        return view('sites.verify.email');
    }

    public function verifySendEmailToken(int $id, string $token): RedirectResponse
    {
        if (!$this->userService->existsById($id) && !$this->userService->existsByTokenAndUser($id, $token)) {
            return redirect()->back()->with(['error' => 'Данное действие запрещенно.'])->withInput();
        }

        $this->userService->successVerifyEmail($id);

        return redirect()->route('main')->with(['success' => 'Электронная почта успешно подтвержденна.'])->withInput();
    }
}