<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\User;
use App\DataTransObject\UserDTO;
use App\Repositories\Admin\UserRepository;
use App\VO\UserAdminVO;
use Illuminate\Database\Eloquent\Collection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\MediaCannotBeDeleted;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ){
        $this->userRepository = $userRepository;
    }

    public function getAll(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function create(UserDTO $DTO): void
    {
        $user = $this->userRepository->create($DTO);
        $user->viberVerify()->create(['code' => generateCode()]);
    }

    public function findById(int $id): User
    {
        return $this->userRepository->findById($id);
    }

    public function update(int $id, UserDTO $DTO)
    {
        $this->userRepository->update($id, $DTO);
    }

    public function delete(int $id): void
    {
        $this->userRepository->delete($id);
    }

    public function moderationUser(): Collection
    {
        return $this->userRepository->moderationUser();
    }

    public function resetPassword(string $email, string $pass): void
    {
        $this->userRepository->changePassword($email, $pass);
    }

    public function exists(int $id): bool
    {
        return $this->userRepository->existsById($id);
    }

    public function bannedAdmin(int $id): void
    {
        $user = $this->findById($id);
        $user->update(['ban' => true]);
    }

    public function changeRoleAndBan(int $id, UserAdminVO $VO)
    {
        $user = $this->findById($id);
        $user->update($VO->toArray());
    }

    #================================== [CUSTOM METHODS MEDIA LIBRARY] ==================================#

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function storeMedia(User $user, array $media): void
    {
        $user->addMedia($media)->toMediaCollection('media', 'media');
    }

    /**
     * @throws MediaCannotBeDeleted
     */
    public function deleteMedia(User $user, Media $media): void
    {
        $user->deleteMedia($media->id);
    }
}