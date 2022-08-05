<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SKPDController;
use App\Http\Controllers\AdminController;


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
    return view('guest.login');
})->middleware('guest');

Route::get('/register',[RegisterController::class,'index'])->middleware('guest');
Route::post('/register',[RegisterController::class,'store']);

Route::get('/login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);

Route::get('/dashboard',[DashboardController::class,'index'])->middleware('auth');

Route::middleware('auth')->group(function() {
    Route::get('/dashboard/profile',[DashboardController::class,'profile']);
    Route::put('/dashboard/editProfile/{id}',[DashboardController::class,'editProfile']);
});

// Superadmin
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/dashboard/role',[SuperAdminController::class,'role']);
    Route::get('/dashboard/dinas',[SuperAdminController::class,'dinas']);
    Route::post('/dashboard/addUser',[SuperAdminController::class,'addUser']);
    Route::put('/dashboard/editUser/{id}',[SuperAdminController::class,'editUser']);
    Route::delete('/dashboard/deleteUser/{id}',[SuperAdminController::class,'deleteUser']);
    Route::post('/dashboard/addRole',[SuperAdminController::class,'addRole']);
    Route::post('/dashboard/addDinas',[SuperAdminController::class,'addDinas']);
    Route::put('/dashboard/editDinas/{id}',[SuperAdminController::class,'editDinas']);
    Route::delete('/dashboard/deleteDinas/{id}',[SuperAdminController::class,'deleteDinas']);
    Route::put('/dashboard/editRole/{id}',[SuperAdminController::class,'editRole']);
    Route::delete('/dashboard/deleteRole/{id}',[SuperAdminController::class,'deleteRole']);
});

// SKPD
Route::middleware(['auth', 'role:skpd'])->group(function (){
    Route::get('/dashboard/skpd/addprodukhukum',[SKPDController::class,'addprodukhukum']);
    Route::post('/dashboard/skpd/addprodukhukum',[SKPDController::class,'storeprodukhukum']);
    Route::get('/dashboard/skpd/readprodukhukum/{id}',[SKPDController::class,'readprodukhukum']);
    Route::get('/dashboard/skpd/editprodukhukum/{id}',[SKPDController::class,'editprodukhukum']);
    Route::put('/dashboard/skpd/editprodukhukum/{id}',[SKPDController::class,'updateprodukhukum']);
    Route::delete('/dashboard/skpd/deleteprodukhukum/{id}',[SKPDController::class,'deleteprodukhukum']);
});

// Admin FO
Route::middleware(['auth', 'role:admin_fo'])->group(function (){
    Route::get('/dashboard/admin/readprodukhukum/{id}',[AdminController::class,'readprodukhukum']);
    Route::get('/dashboard/admin/editprodukhukum/{id}',[AdminController::class,'editprodukhukum']);
    Route::post('/dashboard/admin/process/{id}',[AdminController::class,'process']);
});