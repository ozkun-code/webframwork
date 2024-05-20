<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT; //panggil library JWT
use Firebase\JWT\Key; //panggil library key

class CategoryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $jwt = $request->bearerToken();

        //kondisi jika token kosong atau tidak
        if($jwt == 'null' || $jwt == '') {
            return response()->json([
                'msg'=>'Access denied, token not fulfilled'
            ], 401);
        } else {

            $jwtDecoded = JWT::decode($jwt, new Key(env('JWT_SECRET_KEY'), 'HS256'));

            //kondisi jika role setelah token di decrypt adalah admin
            if($jwtDecoded->role == 'admin') {
                return $next($request);
            }

            return response()->json([
                'msg'=>'Access denied, token not fulfilled'
            ], 401);
        }
    }
}
