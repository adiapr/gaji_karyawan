<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
    toast('Success Toast','success');
    return view('welcome');
});

Auth::routes();
// mengelompokkan middleware
Route::middleware(['admin'])->group(function(){

    Route::get('/home',         [HomeController::class, 'index']);
    Route::get('/tables',       [HomeController::class, 'tables']);
    Route::get('/dynamictables',[HomeController::class, 'dynamictables']);

    // user
    Route::get('/karyawan',                 [UserController::class, 'index']);
    Route::post('/karyawan/hapus/{id}',     [UserController::class, 'delete'])->name('karyawan.hapus');
    Route::post('/karyawan/update/{id}',    [UserController::class, 'perbaharui'])->name('karyawan.update');
    Route::post('/karyawan/add',            [UserController::class, 'add'])->name('karyawan.add');

    // rekap-gaji
    Route::get('/admin/kelola-gaji',        [GajiController::class, 'index']);
    Route::post('/gaji/add',                [GajiController::class, 'add'])->name('gaji.add');
    Route::post('/gaji/hapus/{id}',         [GajiController::class, 'delete'])->name('gaji.hapus');
    Route::post('/gaji/update/{id}',        [GajiController::class, 'update'])->name('gaji.update');

    // import excel
    Route::post('karyawan/import_excel',    [UserController::class, 'import_excel']);
    Route::post('gaji/import_excel',        [GajiController::class, 'import_excel']);

    // export excel
    Route::get('/user/export',              [UserController::class, 'export']);

    // autofill $ complete
    Route::post('/admin/kelola-gaji',       [GajiController::class, 'autocomplete'])->name('nama');


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


// membuat search 
Route::get('/search',       [GajiController::class, 'search']);
Route::get('/autocomplete', [GajiController::class, 'autocomplete'])->name('autocomplete');
