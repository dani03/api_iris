<?php

namespace App\Http\Repositories\Users;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function createUser(RegisterRequest $request)
    {
        return User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        );
    }

    public function findUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function find(int $id): ?User
    {
        return User::find($id);
    }

    public function users()
    {
        return User::paginate(15);
    }

    public function updateUser(User $user, array $data): bool
    {
        return $user->update($data);
    }
}
