<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthenticationService;
use App\Services\AuthStrategies\EmailPasswordStrategy;
use App\Repositories\UserRepository;

class AuthController extends Controller
{
    protected $authService;
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->authService = AuthenticationService::getInstance($userRepository);
    }

    public function login(Request $request)
    {
        $strategy = new EmailPasswordStrategy($this->userRepository);
        $credentials = $request->only('email', 'password');
        
        $user = $this->authService->login($strategy, $credentials);

        if ($user) {
            return response()->json(['user' => $user]);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function register(Request $request)
    {
        $strategy = new EmailPasswordStrategy($this->userRepository);
        $data = $request->all();
        
        $user = $this->authService->register($strategy, $data);

        return response()->json(['user' => $user]);
    }
}
