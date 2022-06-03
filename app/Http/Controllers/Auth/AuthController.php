<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Factories\UserFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRegisterRequest;

class AuthController extends Controller
{
    protected UserFactory $userFactory;
    protected UserService $userService;

    public function __construct(
        UserFactory $userFactory,
        UserService $userService
    ){
        $this->userFactory = $userFactory;
        $this->userService = $userService;
    }

    public function index()
    {
        return view('sites.auth.index');
    }

    public function customRegister()
    {
        return view('sites.auth.register');
    }

    /**
     * @throws \Throwable
     */
    public function register(UserRegisterRequest $request): RedirectResponse
    {
        \DB::beginTransaction();
        try {
            $DTO = $this->userFactory->store($request);
            $this->userService->create($DTO);
            \DB::commit();

        }catch (\Throwable $exception) {
            \DB::rollBack();

            return redirect()->back()->withErrors(['errors' => $exception->getMessage()]);
        }

        return redirect()->route('new.customer.verify')->withInput(['success' => 'Successfully registration in services.']);
    }

    public function customLogin()
    {
        return view('sites.auth.login');
    }

    /**
     * @throws \Throwable
     */
    public function login(UserLoginRequest $request): RedirectResponse
    {
        try {
            $credentials = $request->only('email', 'password');
            \Auth::attempt($credentials, (int) $request->input('remember'));
        }catch (\Throwable $exception) {
            return redirect()->back()->withErrors(['errors' => $exception->getMessage()]);
        }

        return redirect()->route('main')->with(['success' => 'Вход выполнен успешно.'])->withInput();
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        \Auth::logout();

        return redirect()->route('main')->withInput(['success' => 'Выход успешно выполнен!.']);
    }
}