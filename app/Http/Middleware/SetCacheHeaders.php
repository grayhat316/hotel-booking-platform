<?php

namespace App\Http\Middleware;

use Illuminate\View\Middleware\ShareErrorsFromSession as Middleware;

class SetCacheHeaders extends Middleware
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
