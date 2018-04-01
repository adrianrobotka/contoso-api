<?php

namespace App\Http\Middleware;

use Closure;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         * Check apikey
         */
        if ($request->has("apikey")) {
            // Check if app apikey is defined
            if (env('APIKEY', 'default') != 'default' && $request->get("apikey") != env('APIKEY')) {
                return response()->json([
                    "error" => "Not valid apikey"
                ], 403);
            }
        } else {
            return response()->json([
                "error" => "No apikey provided"
            ], 403);
        }

        return $next($request);
    }
}
