<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdminController;


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

// Superadmin
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/role',[SuperAdminController::class,'role']);
    Route::get('/dashboard/dinas',[SuperAdminController::class,'dinas']);
    Route::get('/dashboard/profile',[SuperAdminController::class,'profile']);
    Route::post('/dashboard/addUser',[SuperAdminController::class,'addUser']);
    Route::post('/dashboard/editUser',[SuperAdminController::class,'editUser']);
});