<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;

class SaasSubscriptionCheck
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
