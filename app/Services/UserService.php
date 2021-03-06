<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Bots\Telegram;
use App\Mail\VerifyEmailMail;
use App\DataTransObject\AuthDTO;
use App\DataTransObject\UserDTO;
use Illuminate\Http\UploadedFile;
use App\Repositories\UserRepository;
use App\Services\Media\MediaService;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;

class UserService
{
    protected Telegram $telegram;
    protected MediaService $mediaService;
    protected UserRepository $userRepository;

    public function __construct(
        Telegram $telegram,
        MediaService $mediaService,
        UserRepository $userRepository
    ){
        $this->telegram = $telegram;
        $this->mediaService = $mediaService;
        $this->userRepository = $userRepository;
    }

    public function create(AuthDTO $DTO): void
    {
        $user = $this->userRepository->create($DTO);
        $user->emailTokenVerify()->create(['token' => md5(\Str::random(64))]);
//        $this->sendEmail($user);
    }

    public function findById(int $id): ?User
    {
        return $this->userRepository->getById($id);
    }

    public function getByEmail(string $email): User
    {
        return $this->userRepository->getByEmail($email);
    }

    public function update(int $id, UserDTO $userDTO)
    {
        $this->userRepository->update($id, $userDTO);
    }

    public function resetPassword(string $email, string $pass): void
    {
        $this->userRepository->changePassword($email, $pass);
    }

    public function existsById(int $id): bool
    {
        return $this->userRepository->existsById($id);
    }

    public function existsByEmail(string $email): bool
    {
        return $this->userRepository->existsByEmail($email);
    }

    private function sendEmail(User $user)
    {
        \Mail::to('yuriydyachuk91@gmail.com')->send(new VerifyEmailMail($user->id, $user->emailTokenVerify()->value('token')));
    }

    public function existsByTokenAndUser(int $id, string $token): bool
    {
        $user = $this->findById($id);
        return $user->emailTokenVerify()->where(['token' => $token])->exists();
    }

    public function successVerifyEmail(int $id): void
    {
        $user = $this->findById($id);
        $user->update(['verify' => true]);
        $user->emailTokenVerify()->delete();
    }

    public function getAllFollowerUser(int $id)
    {
        $user = $this->findById($id);

        return $user->followersConfirm()->paginate(5);
    }

    public function getMyFollowers(): LengthAwarePaginator
    {
        return request()->user()->followers()->wherePivot('confirmed', false)->paginate(10);
    }

    #================================== [CUSTOM METHODS MEDIA LIBRARY] ==================================#

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function storeMedia(User $user, UploadedFile $media): void
    {
        if ($user->media()->exists()) {
            $user->media()->first()->delete();
        }

        $user->addMedia($media)->toMediaCollection('media', 'media');
    }
}