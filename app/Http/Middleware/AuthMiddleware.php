<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT; //
use Firebase\JWT\Key; //

//tidak dipakai
class AuthMiddleware
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
        //ambil token dan masukkan ke variabel $token
        $jwt = $request->bearerToken();

        //cek jika jwt null atau kosong
        if($jwt == 'null' || $jwt == '') {
            //jika ya maka response ini muncul
            return response()->json([
                'msg'=>'Akses ditolak, token tidak memenuhi'
            ], 401);
        } else {

            //decode token
            $jwtDecoded = JWT::decode($jwt, new Key(env('JWT_SECRET_KEY'), 'HS256'));

            //jika token itu milik admin
            if($jwtDecoded->role == 'admin') {
                return $next($request);
            }

            //jika tidak maka response ini muncul
            return response()->json([
                'msg'=>'Akses ditolak, token tidak memenuhi'
            ], 401);
        }
    }
}
