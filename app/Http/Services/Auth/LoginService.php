<?php


namespace App\Http\Services\Auth;

class LoginService{

    public function loggingIn($credentials, $token){

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'token' => $token,
            'expires' => auth('api')->factory()->getTTL() * 60,
        ]);

    }

}