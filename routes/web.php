<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('index',[PageController::class,'getIndex'])->name('trang-chu');
Route::get('loai-san-pham/{type?}',[PageController::class,'getTypeProduct'])->name('loai-san-pham');
Route::get('chi-tiet-san-pham/{id?}',[PageController::class,'getDetailProduct'])->name('chi-tiet-san-pham');
Route::get('lien-he',[PageController::class,'getContact'])->name('lien-he');
Route::get('gioi-thieu',[PageController::class,'getAbout'])->name('gioi-thieu');
Route::get('dang-nhap',[PageController::class,'getLogin'])->name('login');
Route::post('dang-nhap',[PageController::class,'postLogin'])->name('login');
Route::get('dang-ki',[PageController::class,'getSignup'])->name('signup');
Route::post('dang-ki',[PageController::class,'postSignup'])->name('signup');
Route::get('dang-xuat',[PageController::class,'postLogout'])->name('logout');
Route::get('search',[PageController::class,'getSearch'])->name('search');
