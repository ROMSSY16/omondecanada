<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App; // Add this line
use App\Http\Controllers\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        App::setLocale('fr');
        return $next($request);
    }
}
