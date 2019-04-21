<?php

namespace App\Repositories;

use App\Models\User;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmailMailable;

class UserRepository implements UserRepositoryInterface
{
    public function allUsers()
    {
        return User::with(['books'])->paginate(15);
    }

    public function createUser(UserRequest $request)
    {
        $request["max_number_of_books_allowed"] = 3;
        $user = User::create($request->all());
        Mail::to($user->email)->send(new VerifyEmailMailable($user));
    }

    public function showUser($id)
    {
        return User::where('id', '=', $id)->with(['books'])->first();        
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
