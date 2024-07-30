<?php

namespace App\Services;

use App\Services\AuthStrategies\AuthStrategyInterface;
use App\Repositories\UserRepository;

class AuthenticationService
{
    private static $instance = null;
    protected $userRepository;

    private function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public static function getInstance(UserRepository $userRepository)
    {
        if (self::$instance == null) {
            self::$instance = new AuthenticationService($userRepository);
        }

        return self::$instance;
    }

    public function login(AuthStrategyInterface $strategy, $credentials)
    {
        return $strategy->login($credentials);
    }

    public function register(AuthStrategyInterface $strategy, $data)
    {
        return $strategy->register($data);
    }
}
