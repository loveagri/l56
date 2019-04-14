<?php

namespace App\Http\Middleware;

use App\Common\Auto\JwtAuth;
use App\Http\Response\ResponseJson;
use Closure;

class JwtMiddleware
{
    use ResponseJson;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->input('token');
        if ($token){
            $jwtAuth = JwtAuth::getInstance();
            $jwtAuth -> setToken($token);

            if ($jwtAuth->validate() && $jwtAuth->verify()){
                return $next($request);
            }else{
                return $this->jsonData(1, 'login expired');
            }
        }else{
            return $this->jsonData(2, 'params error');
        }
    }
}

















