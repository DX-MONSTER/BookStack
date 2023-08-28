<?php

namespace App\Http\Controllers\Auth;

use App\Auth\Access\LoginService;
use App\Auth\User;
use App\Exceptions\NotFoundException;

trait HandlesPartialLogins
{
    /**
     * @throws NotFoundException
     */
    protected function currentOrLastAttemptedUser(): User
    {
        $loginService = app()->make(LoginService::class);
        $user = auth()->user() ?? $loginService->getLastLoginAttemptUser();

        if (!$user) {
            throw new NotFoundException('A user for this action could not be found');
        }

        return $user;
    }
}
