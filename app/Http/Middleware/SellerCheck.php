<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Facades\JWTAuth;

class SellerCheck
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        Config::set('auth.providers.users.model',\App\Models\Seller::class);
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return $this->errorResponse('User Not Found',404);
            }
    
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
    
            // return response()->json(['token_expired'], $e->getStatusCode());
           return $this->errorResponse('Token expired');
    
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
    
           return $this->errorResponse('Token Invalid');
    
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
    
          return $this->errorResponse('Token Eror');
    
        }
    
        return $next($request);
    }
}
