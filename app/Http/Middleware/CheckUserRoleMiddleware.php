<?php

namespace App\Http\Middleware;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\HomeController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::user()->role === UserRoleEnum::from($role)) {
            return $next($request);
        } else {
            if ($request->wantsJson())
                return response()->json(['message' => 'Unauthenticated'], 401);
            else
                return redirect()->route('home');
        }
    }
}
