<?php

namespace App\Contracts;

use App\Models\User;
use App\Http\Requests\UserRequest;

interface UserRepositoryInterface
{
    public function allUsers();

    public function createUser(UserRequest $request);

    public function showUser($id);

    public function updateUser(UserRequest $request, User $user);

    public function deleteUser(User $user);
}