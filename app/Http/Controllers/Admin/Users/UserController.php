<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Users;

use App\Factories\UserAdminFactory;
use App\Services\Admin\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;
    private UserAdminFactory $userAdminFactory;

    public function __construct(
        UserService $userService,
        UserAdminFactory $userAdminFactory
    ){
        $this->userService = $userService;
        $this->userAdminFactory = $userAdminFactory;
    }

    public function index()
    {
        return view('admin.users.index', [
                    'users' => $this->userService->getAll()
                ]);
    }

    public function show(int $id)
    {
        return view('admin.users.show', [
                    'user' => $this->userService->findById($id)
                ]);
    }

    public function edit(int $id)
    {
        return view('admin.users.edit', [
                'user' => $this->userService->findById($id)
            ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $userVO = $this->userAdminFactory->create($request);
        $this->userService->changeRoleAndBan($id, $userVO);

        return redirect()->route('admin.users.index')->with(['success' => 'Пользователь успешно обновлен.'])->withInput();
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->userService->delete($id);

        return redirect()->back()->with(['success' => 'Пользователь успешно удален.'])->withInput();
    }

    public function moderation()
    {
        return view('admin.users.moderation', [
                    'users' => $this->userService->moderationUser()
                ]);
    }
}
