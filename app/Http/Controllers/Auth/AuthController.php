<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Factories\AuthFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRegisterRequest;

class AuthController extends Controller
{
    protected AuthFactory $authFactory;
    protected UserService $userService;

    public function __construct(
        AuthFactory $authFactory,
        UserService $userService
    ){
        $this->authFactory = $authFactory;
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
            $DTO = $this->authFactory->store($request);
            $this->userService->create($DTO);
            \DB::commit();

        }catch (\Throwable $exception) {
            \Log::info('MESSAGE ======== ' . $exception->getMessage());
            \DB::rollBack();

            return redirect()->back()->with(['error' => $exception->getMessage()])->withInput();
        }

        return redirect()->route('new.customer.verify')->with(['success' => 'Регистрация на сервисе прошла успешно.'])->withInput();
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
            $user = $this->userService->getByEmail($request->input('email'));
            $credentials = $request->only('email', 'password');
            if (!\Hash::check($request->input('password'), $user->password)) {
                return redirect()->back()->with(['error' => 'Пароль введен неправильно!'])->withInput();
            }

            \Auth::attempt($credentials, (int) $request->input('remember'));
        }catch (\Throwable $exception) {
            return redirect()->back()->with(['error' => $exception->getMessage()])->withInput();
        }

        return redirect()->route('main')->with(['success' => 'Вход выполнен успешно.'])->withInput();
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        \Auth::logout();

        return redirect()->route('main')->with(['success' => 'Выход успешно выполнен!.'])->withInput();
    }
}