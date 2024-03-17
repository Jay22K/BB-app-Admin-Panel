<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user && $user->status == 1) {
            return $next($request);
        } else {
            if ($user->status == 0) {
                $statusMsg = 'is inactive';
            } else if ($user->status == 2) {
                $statusMsg = 'is pending';
            } elseif ($user->status == 3) {
                $statusMsg = 'verification is pending from admin';
            } else if ($user->status == 4) {
                $statusMsg = 'has been suspended';
            }
            return response()->json(['status' => 0, 'message' => 'Customer account ' . $statusMsg . '.', 'data' => []]);
        }
    }
}
