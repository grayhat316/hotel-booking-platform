<?php

namespace App\Http\Middleware;

use Illuminate\Session\Middleware\AuthenticateSession as Middleware;

class AuthenticateSession extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array<int, string>
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}
