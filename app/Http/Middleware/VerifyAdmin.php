<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class VerifyAdmin
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
        $token = session('jwt_token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['message' => 'Please login first']);
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();

            if ($user && $user->isAdmin) {
                return $next($request);
            } else {
                return redirect()->route('forbidden');
            }
        } catch (TokenExpiredException $e) {
            return redirect()->route('login')->withErrors(['message' => 'Token has expired, please login again']);
        } catch (TokenInvalidException $e) {
            return redirect()->route('login')->withErrors(['message' => 'Invalid token, please login again']);
        } catch (JWTException $e) {
            return redirect()->route('login')->withErrors(['message' => 'Token not found, please login']);
        }
    }
}
