<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login() {
        $credentials = request(['email', 'password']);
        $token = auth()->attempt($credentials);
        if(!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            return $this->respondWithToken($token); // Helping method
        }
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message', 'Successfully logged out!']);
    }

    protected function respondWithToken($token) {
        return response()->json([
           'access_token' => $token,
           'token_type' => 'bearer',
           'expires_in' => auth()->factory()->getTTL()*60
        ]);
    }
}
