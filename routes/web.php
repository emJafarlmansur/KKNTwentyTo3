<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::get('login',[AuthController::class,'login'] )->name('login'); //route ini untuk menampilkan halaman , ->name berhubungan dengan file authencticate yang berada di folder midelwer yang berisi pengarahan ke halaman 'login

Route::post('login',[AuthController::class,'authenticate']); //route dengan method post ini digunakan untuk melakukan pemrosesan saat lojin, apakah sudah susuai dengan aturan lojin yang disarankan

Route::get('dashboard',[AdminController::class,'index'])->middleware('auth','only_admin'); // untuk menambhakan only_client harus ditambahkan di file
Route::get('profile',[UserController::class,'profile'])->middleware('auth','only_client');