<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Models\Interest;
use App\Services\UserService;
use App\Factories\UserFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\UserChangeRequest;

class ProfileController extends Controller
{
    private UserService $userService;
    private UserFactory $userFactory;

    public function __construct(
        UserService $userService,
        UserFactory $userFactory
    ){
        $this->userService = $userService;
        $this->userFactory = $userFactory;
    }

    public function show(int $id)
    {
        $user = $this->userService->findById($id);
        $paginate = $user->setRelation('reports', $user->reports()->paginate(2));

        return view('sites.profiles.index', [
                    'user' => $user,
                    'paginate' => $paginate,
                    'interests' => Interest::query()->get()
                ]);
    }

    public function update(UserChangeRequest $request, int $id): RedirectResponse
    {
        $DTO = $this->userFactory->store($request);
        $this->userService->update($id, $DTO);

        return redirect()->back()->with(['success' => 'Данные успешно обновленны.'])->withInput();
    }
}