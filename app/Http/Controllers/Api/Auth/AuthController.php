<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwtVerify', ['except' => ['login', 'signup']]);
    }


    public function signup(Request  $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

       $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

       if ($user){
           return $this->login($request);
       }else{
           return response()->json(['error' => 'Something is wrong, Please try again letter'], 500);
       }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }
        return response()->json(['error' => 'Email or Password is invalid'], 401);
    }


    public function me()
    {
        return response()->json($this->guard()->user());
    }


    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
            'name' => Auth::user()->name,
            'id' => Auth::user()->id,
        ]);
    }


    public function guard()
    {
        return Auth::guard();
    }
}
