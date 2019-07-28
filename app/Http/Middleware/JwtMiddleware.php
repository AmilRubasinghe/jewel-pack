<?php
namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware
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
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                
                return response()->json(['status' => 'Token is Invalid']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                //JWTAuth::invalidate($request->input('token'));
                return response()->json(['status' => 'Token is Expired','exp' => 1]);
            }else{
                return response()->json(['status' => 'Authorization Token not found']);
            }
        }

        if ($user && in_array($user->role, $roles)) {
            return $next($request);
        }
    
        return $this->unauthorized();
    }

    private function unauthorized($message = null){
        return response()->json([
            'status' => $message ? $message : 'You are unauthorized to access this resource',
            'success' => false
        ], 401);
    }
}










/*





<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware
{

    public function handle($request, Closure $next, ...$roles)
    {
        try {
            //Access token from the request        
            $token = JWTAuth::parseToken();
            //Try authenticating user       
            $user = $token->authenticate();
        } catch (TokenExpiredException $e) {
            //Thrown if token has expired       

            return response()->json(['status' => 'Token is Expired'return response()->json(['status' => 'Token is Expired','exp' => 1]);return response()->json(['status' => 'Token is Expired','exp' => 1]);return response()->json(['status' => 'Token is Expired','exp' => 1]);return response()->json(['status' => 'Token is Expired','exp' => 1]);]);
        } catch (TokenInvalidException $e) {
            //Thrown if token invalid
            return $this->unauthorized('Your token is invalid. Please, login again.');
        }catch (JWTException $e) {
            //Thrown if token was not found in the request.
            return $this->unauthorized('Please, attach a Token to your request');
        }
        //If user was authenticated successfully and user is in one of the acceptable roles, send to next request.
        if ($user && in_array($user->role, $roles)) {
            return $next($request);
        }
    
        return $this->unauthorized();
    }
    
    private function unauthorized($message = null){
        return response()->json([
            'status' => $message ? $message : 'You are unauthorized to access this resource',
            'success' => false
        ], 401);
    }
}
*/
