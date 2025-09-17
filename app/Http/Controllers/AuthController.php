<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {}

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        return $this->authService->login($data);
    }

    public function logout()
    {
        return $this->authService->logout();
    }

    public function me()
    {
        return $this->authService->me();
    }

    public function register(RegisterRequest $request){
        $data = $request->validated();
        return $this->authService->register($data);
    }
}
