<?php

namespace App\Contracts;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function allUsers();

    public function showUser($id);

    public function createUser(UserRequest $request);

    public function updateUser(EditUserRequest $request, User $user);

    public function deleteUser(User $user);
}