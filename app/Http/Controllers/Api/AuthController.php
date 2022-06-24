<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login()
    {
        $cradentials = request(['email', 'password']);

        $token = Auth::guard('api')->attempt($cradentials);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized', 401]);
        }

        return $this->respondWithToken($token);
    }

    public function register()
    {
        $validator = Validator::make(request()->all(), [
            'reg_number' => ['required', 'string', 'min:8', 'max:255', 'unique:guests'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json(["data" => [], "error" => true, "message" => $validator->errors()], 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt(request('password'))]
        ));

        return response()->json([
            'message'  => 'User successfully registered',
            'data'     => $user,
            'error'    => false
        ], 201);
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
