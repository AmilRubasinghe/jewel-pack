<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        try {
            //Access token from the request        
            $token = JWTAuth::parseToken();
            //Try authenticating user       
            $user = $token->authenticate();
        }
        if ($user && in_array($user->role, $roles)) {
            return $next($request);
        }
    
        return $this->unauthorized();
    }
    
    private function unauthorized($message = null){
        return response()->json([
            'message' => $message ? $message : 'You are unauthorized to access this resource',
            'success' => false
        ], 401);
    }
}
