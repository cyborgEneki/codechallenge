<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Contracts\UserRepositoryInterface;

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
    /**
         * Register api
         *
         * @return \Illuminate\Http\Response
         */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'max_number_of_books_allowed' => 'required',
            'status' => 'required',
            'department_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], $this-> successStatus);
    }
    /**
         * details api
         *
         * @return \Illuminate\Http\Response
         */
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

    public function update(Request $request, User $user)
    {
        $user = $this->userRepo->updateUser($request, $user);
        return response()->json($user, 200);
    }

    public function destroy(User $user)
    {
        $user = $this->userRepo->deleteUser($user);
        return response()->json($user, 200);
    }
}
