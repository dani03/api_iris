<?php

namespace App\Http\Services\Users;

use App\Http\Repositories\Users\UserRepository;
use App\Models\User;
use Illuminate\Support\Collection;

readonly class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function getUser(int $userId): User | null
    {
        return $this->userRepository->find($userId);

    }

    public function getAllUsers()
    {
        return $this->userRepository->users();
    }

    public function updateUserNameAndEmail(User $user, array $datas): bool
    {
        $newDatas = ['email' => $datas['email'], 'name' => $datas['name']];
       return  $this->userRepository->updateUser($user, $newDatas);
    }



}
