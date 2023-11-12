<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TenantSetupCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (tenancy()->initialized && tenant()->setup_completed)
        {
            return $next($request);
        }

        if (Auth::check() && Auth::user() instanceof Admin)
        {
            return redirect()->route('tenant.setup');
        }

        return response()->view('errors.tenant_out_of_service');
    }
}
