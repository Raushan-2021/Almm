<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure, Route;

class SecurityHeaders
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
        return $next($request);
        if(in_array(request()->segment(2), ['preview-docs', 'download-docs'])){
            
        }
        else
        {
            $response = $next($request);
            $response->header('X-Frame-Options', 'SAMEORIGIN');
            $response->header('X-XSS-Protection', '1; mode=block');
            $response->header('X-Content-Type-Options', 'nosniff');
            $response->header('Cache-Control', 'max-age=0, must-revalidate, no-cache, no-store');
            $response->header('Strict-Transport-Security', 'max-age=60000; includeSubDomains');
            return $response;
        }
    }
}
