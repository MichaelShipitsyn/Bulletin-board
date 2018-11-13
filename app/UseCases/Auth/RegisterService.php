<?php

namespace App\UseCases\Auth;

use App\Entity\User;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Auth\Events\Registered;

class RegisterService
{
    public function register(RegisterRequest $request): void
    {
        $user = User::register(
            $request['name'],
            $request['email'],
            $request['password']
        );

        event(new Registered($user));
    }

    public function verify($id): void
    {
        $user = User::findOrFail($id);
        $user->verify();
    }
}