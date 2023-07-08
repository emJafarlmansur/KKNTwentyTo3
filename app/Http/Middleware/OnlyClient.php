<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OnlyClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        {
            if(Auth::user()->role_id != 2){
              return redirect('dashboard')  ; // kode ini menjelaskan ketika admin sudah login dia g bisa ngakses hlaman profile yang dikhususkan untuk role use, dan juga sebaliknya
            }
            return $next($request);
        }
    }
} 

//fungsi only client bisa digunakan untuk mengimplementasikan projek absen, dgn kondisi ketika lojin sebagai siswa tidak bisa mengakses dasboard atau ketika lojin sebagai guru tidak bisa mengakses halaman absensi siswa
