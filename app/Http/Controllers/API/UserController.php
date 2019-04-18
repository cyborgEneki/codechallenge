<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Contracts\UserRepositoryInterface;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EditUserRequest;

class UserController extends Controller
{
    protected $userRepo;
    public $successStatus = 200;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    /**
         * login api
         *
         * @return \Illuminate\Http\Response
         */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json(['success' => $success], $this-> successStatus);
        } else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }

    public function index()
    {
        $users = $this->userRepo->allUsers();
        return response()->json($users, 200);
    }

    public function show($id)
    {
        $user = $this->userRepo->showUser($id);
        return response()->json($user, 200);
    }

    public function store(UserRequest $request)
    {
        $user = $this->userRepo->createUser($request);
        return response()->json($user, 201);
    }

    public function update(EditUserRequest $request, User $user)
    {
        $user = $this->userRepo->updateUser($request, $user);
        return response()->json($user, 200);
    }

    public function destroy(User $user)
    {
        $user = $this->userRepo->deleteUser($user);
        return response()->json($user, 200);
    }

    public function isAdmin() 
    {
        $result = Auth::User()->accesslevel_id == 1;
        return response()->json($result, 200);
    }
}
