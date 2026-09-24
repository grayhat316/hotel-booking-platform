<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\SubstituteBindings as Middleware;

class RedirectIfAuthenticated extends Middleware
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
