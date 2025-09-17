<?php

namespace App\Services;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login($data){
        $auth = Auth::attempt([$data['email'], $data['password']], true);
        if ($auth){
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function logout(){
        Auth::user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me(){
        return response()->json([
            'user' => Auth::user()
        ]);
    }

    public function register($data){
        // Logic for user registration
        $email = $this->checkEmail($data['email']);
            $user = User::create([
                'name' => $data['name'],
                'email' => $email,
                'password' => bcrypt($data['password']),
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
    }

    public function checkEmail($email)
    {
        $email = User::where('email', $email)->first();
        if ($email){
            throw new \Exception('Email already exists');
        }else{
            return $email;
        }
    }


}
