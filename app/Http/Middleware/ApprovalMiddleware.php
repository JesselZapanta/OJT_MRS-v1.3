<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApprovalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check the 'approved' column in the user's database record
            $user = Auth::user();

            if ($user->status == 'approved') {
                return $next($request);
            }elseif($user->status == 'declined'){
                // User is not approved, redirect to login page
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account registration was declined.');
            }
        }
        
        // User is not approved, redirect to login page
        Auth::logout();
        return redirect()->route('login')->with('error', 'Your account is not approved, please wait');
    }
}
