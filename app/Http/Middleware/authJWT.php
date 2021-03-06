<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Facades\Cookie;
 
class authJWT
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
        \Config::set('jwt.user' , "App\Models\Admin");
        \Config::set('auth.providers.users.model', \App\Models\Admin::class);
        $token = Cookie::get('token');
        try {
            if (!$user = JWTAuth::toUser($token)){
                return response()->json([
                    'errcode' => 400004,
                    'errmsg' => '无此用户'
                ], 404);
            }
 
        } catch (TokenExpiredException $e) {
 
            return response()->json([
                'errcode' => 400001,
                'errmsg' => 'token 过期'
            ], $e->getStatusCode());
 
        } catch (TokenInvalidException $e) {
 
            return response()->json([
                'errcode' => 400003,
                'errmsg' => 'token 失效'
            ], $e->getStatusCode());
 
        } catch (JWTException $e) {
 
            return response()->json([
                'errcode' => 400002,
                'errmsg' => 'token 参数错误'
            ], $e->getStatusCode());
 
        }
        return $next($request);
    }
 
 
}

