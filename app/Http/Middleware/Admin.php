<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            Log::info('Middleware check - User type: ' . $user->usertype);

            if ($user->usertype !== 'admin') {
                Log::info('Redirecting non-admin user to dashboard');
                return redirect()->route('dashboard');
            }
        } else {
            Log::info('No authenticated user');
        }

        return $next($request);
    }
}

