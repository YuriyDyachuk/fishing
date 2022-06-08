<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Requests\UserMediaRequest;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;

class MediaProfileController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(UserMediaRequest $request, int $id): RedirectResponse
    {
        if ($request->file('media')) {
            $this->userService->storeMedia($this->userService->findById($id), $request->file('media'));
        }

        return redirect()->back()->withInput(['message' => 'Фото успешно обновлено.']);
    }
}