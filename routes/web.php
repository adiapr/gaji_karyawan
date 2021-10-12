<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
// mengelompokkan middleware
Route::middleware(['admin'])->group(function(){

    Route::get('/home',         [HomeController::class, 'index']);
    Route::get('/tables',       [HomeController::class, 'tables']);
    Route::get('/dynamictables',[HomeController::class, 'dynamictables']);

    // user
    Route::get('/karyawan',     [UserController::class, 'index']);

    // import excel
    Route::post('karyawan/import_excel', [UserController::class, 'import_excel']);


    // mengelompokan admin
    // Route::middleware(['admin'])->group(function(){
    //     Route::get('/admin', [AdminController::class, 'index']);
    // });

    // mengelompokan user
    // Route::middleware(['user'])->group(function(){
    //     Route::get('/user', [UserController::class, 'index']);
    // });

    // keluar
    Route::get('/logout', function(){
        Auth::logout();
        redirect('/');
    });

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
