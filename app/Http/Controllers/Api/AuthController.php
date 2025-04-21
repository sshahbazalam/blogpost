<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\AuthRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;
    /**
     * Inject auth service 
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(AuthRequest $request)
    {
        $isLoggedIn = $this->authService->login($request->validated());

        if (!$isLoggedIn) {
            return $this->errorApiResponse('Invalid credentials', null, 401);
        }

        $user = $request->user();
        $token = $user->createToken('api-token')->plainTextToken;

        return $this->successApiResponse(trans('token_created'), ['token' => $token], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->successApiResponse(trans('logged_out'), null, 200);
    }
}