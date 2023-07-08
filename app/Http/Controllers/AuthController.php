<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
   public function login()
   {
return view('login');
   }

   public function Authenticate(Request $request)// parameter Request yang ada didalam kurung digunakan karena didalam halaman login ada inputan 
   {
    $credentials = $request->validate([
        'name' => ['required'],
        'password' => ['required'],
    ]);

    //BEBERAPA TAHAPAN PENGECEKAN LOGIN
    //1.cek apakah login valid
    if (Auth::attempt($credentials)) {   //diperlukan import class Auth
        
        
    //2.cek apakah user status = active
        if(Auth::user()->status!='active'){
            Session::flash('status', 'failed'); // jika akun tidak aktif keterangnya filed, dan pesan untuk mengaktifkan muncul

            Session::flash('message', 'akun kamu belum active sepenuhnya, silahkan menghubungi admin untuk mengaktifkan');
            return redirect('login');
        }

       //$request->session()->regenerate(); // baris kode disamping menghandle jika berhasil login tidak akan dikeluarkan dari halaman yang dituju
        if(Auth::user()->role_id==1){
            return  redirect('dashboard');
        }
        if(Auth::user()->role_id==2){
            return redirect('profile');
        }


      
    }
    Session::flash('status', 'error'); // jika akun tidak terdaftar, muncul begini
    Session::flash('message', 'login bermasalahan');
    return redirect('login');

   }
}
