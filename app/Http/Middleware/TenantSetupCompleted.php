<?php

namespace App\Http\Middleware;

use App\Models\Operator;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TenantSetupCompleted
{
    /**
     * Handle an incoming request.F
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (tenancy()->initialized && tenant()->setup_completed)
        {
            return $next($request);
        }

        if (Auth::check() && Auth::user() instanceof Operator)
        {
            return redirect()->route('admin.setup');
        }

        return response()->view('errors.tenant_inactive');
    }
}
