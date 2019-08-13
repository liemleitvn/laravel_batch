<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class Admin
 * @package App\Http\Middleware
 */
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->isAdmin) {
            return $next($request);
        }

        if (Auth::user()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => config('auth.message.permission')], 403);
            }

            //abort(401);
            abort(403, config('auth.message.permission'));
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => config('auth.message.unauthenticated')], 401);
        }

        //abort(401);
        return redirect()->route('login');
    }
}
