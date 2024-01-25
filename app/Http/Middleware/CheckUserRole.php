<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login'); // or your login route
        }

        // Get the user role
        $role = Auth::user()->role; // assuming 'role' is the column name in your users table

        // Allow admin users, redirect regular users
        if ($role == 'admin') {
            return $next($request);
        } else {
            return redirect()->route('home')->with('message','User access denied'); // or wherever you want to redirect regular users
        }
    }
}
