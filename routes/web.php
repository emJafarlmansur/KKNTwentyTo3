<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');// fungsi midelwer ini kalo belum lojin kamu g bisa masuk hal welcom
})->middleware('auth');

    Route::middleware(['only_guest'])->group(function () {
    Route::get('login',[AuthController::class,'login'] )->name('login');
    Route::post('login',[AuthController::class,'authenticate']);
    Route::get('register',[AuthController::class,'register']);
});

Route::middleware(['auth'])->group(function () { //5
    Route::get('logout',[AuthController::class,'logout']);
    Route::get('dashboard',[AdminController::class,'index'])->middleware('only_admin'); //3
    //Route::get('dashboard',[AdminController::class,'index'])->middleware('auth','only_admin'); senelum midleawre group
    Route::get('profile',[UserController::class,'profile'])->middleware('only_client');
    Route::get('books',[BookController::class,'index']);
});




/* CATATAN 

route ini (1) untuk menampilkan halaman , ->name berhubungan dengan file authencticate yang berada di folder midelwer yang berisi pengarahan ke halaman 'login

route dengan (2) method post ini digunakan untuk melakukan pemrosesan saat lojin, apakah sudah susuai dengan aturan lojin yang disarankan

(3) untuk menambhakan only_client harus ditambahkan di file dan juga onlyadmin

fungsi middleware guest/only_guest, bagi siapa saja yang sudah login tidak dapat mengakses halaman login/register

(5) middleware grup berfungsi meringkas penyematan dari beberapa middleware sebelumnya yang ditambahkan kesetiap rute dengan aturan penulisan seperti array . contohnya seperti pada rute dashboard yang dikomentari




*/