<?php

namespace App\Services\AuthStrategies;

interface AuthStrategyInterface
{
    public function login($credentials);
    public function register($data);
}
