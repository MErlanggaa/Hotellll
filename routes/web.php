<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

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

Route::get('/fetch-data', [DataController::class, 'fetchData']);


//User//


Route::get('kamar', [TamuController::class, 'kamar'])->name('kamar');
Route::post('kamar', [TamuController::class, 'insert'])->name('tamu.insert');

Route::middleware('guest')->group(function ()  {
    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('home', ['welcome'])->name('home');
    Route::get('login', [LoginUserController::class, 'formLogin'])->name('login');
    Route::post('login', [LoginUserController::class, 'login']);
    Route::middleware('auth')->group(function () {

    Route::get('/akun', [UserController::class, 'akun'])->name('user.akun');
        Route::put('/akun', [UserController::class, 'updateAkun']);
    Route::post('logout', [LoginUserController::class, 'logout'])->name('user.logout');
    
    });
});

Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});




//admin dan resepsionis//
Route::group([
    'prefix' => config('admin.path'),
], function () {
    Route::get('admin/login', [LoginAdminController::class, 'formLogin'])->name('admin.login');
    Route::post('admin/login', [LoginAdminController::class, 'login']);

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::post('logout', [LoginAdminController::class, 'logout'])->name('admin.logout');
        
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('pemesanan', TamuController::class);

        Route::get('/akun', [AdminController::class, 'akun'])->name('admin.akun');
        Route::put('/akun', [AdminController::class, 'updateAkun']);

        Route::group(['middleware' => ['can:role,"admin"']], function () {
            Route::resource('admin', AdminController::class);
            Route::resource('kamar', KamarController::class);
        });
    });
});