<?php

namespace App\Contracts;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function allUsers();

    public function showUser($id);

    public function updateUser(Request $request, User $user);

    public function deleteUser(User $user);
}