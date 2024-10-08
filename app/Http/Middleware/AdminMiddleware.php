<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Memeriksa apakah pengguna terautentikasi dan memiliki isAdmin = true.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user || !$user->isAdmin) {
                return response()->json([
                    'error' => 'Forbidden. Admins only.',
                    'status' => 403
                ], 403);
            }
        } catch (TokenInvalidException $e) {
            return response()->json([
                'error' => 'Token is Invalid',
                'status' => 401
            ], 401);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'error' => 'Token is Expired',
                'status' => 401
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Authorization Token not found',
                'status' => 401
            ], 401);
        }

        return $next($request);
    }
}
