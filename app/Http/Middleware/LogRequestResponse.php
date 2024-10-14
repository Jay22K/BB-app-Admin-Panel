<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogRequestResponse
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $data = $request->all();

        // If logging an authentication request, mask the password in the log
        if ($request->isMethod('post') && $request->path() === 'api/auth/login' && isset($data['password'])) {
            $data['password'] = 'REDACTED';  // Mask the password
        }

        // Log the request
        // Log::channel('api_error')->info("API Request: {$request->method()}, {$request->fullUrl()}", [
        //     'headers' => $request->headers->all(),
        //     'body' => $data,
        // ]);
        $data = json_encode($data);
        $reqData = "{$request->method()}, {$request->fullUrl()} , {$data}";

        // Continue processing the request
        $response = $next($request);


        // Log the response
        Log::channel('api_error')->info("API Response: {$response->status()}, {$request->fullUrl()}", [
            'req' => $reqData,
            'user' => Auth::user()?->email,
            'body' => json_decode($response->getContent()),
        ]);

        return $response;
    }
}
