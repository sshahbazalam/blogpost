<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthService
{
    /**
     * Login
     * 
     * @param array $credentials
     */
    public function login(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }
}
