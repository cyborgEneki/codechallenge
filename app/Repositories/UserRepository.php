<?php

namespace App\Repositories;

use App\Models\User;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EditUserRequest;

class UserRepository implements UserRepositoryInterface
{
    public function allUsers()
    {
        return User::paginate(10);
    }

    public function createUser(UserRequest $request)
    {
        return User::create($request->all());
    }
    public function showUser($id)
    {
        return User::findOrFail($id);
    }

    public function updateUser(EditUserRequest $request, User $user)
    {
        return $user->update($request->all());
    }

    public function deleteUser(User $user)
    {
        return $user->delete($user);
    }
}
