<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

    $token= $request-> user()?-> currentAccessToken();
    if($token && $token-> expires_at){
        if(Carbon::now()-> greaterThan($token-> expires_at)){
            $token-> delete();
            return response()-> json([
                'message'=> 'Token expired'
            ], 401);
        }
    }

        return $next($request);
    }
}
