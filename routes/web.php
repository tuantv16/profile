<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Backend\MainController;
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

// Route::get('/', function () {
//     return view('dashboard');
// });

Route::get('/', [DashboardController::class, 'index']);


// Route::get('login', [ 'as' => 'login', 'uses' => [MainController::class, 'index']);
Route::get('login', [LoginController::class, 'login'])->name('login');
// Route::get('/login', function () {
//     return view('login-account');
// });

Route::get('/register', function () {
    return view('register-account');
});

Route::post('/register', [RegisterController::class, 'postRegisterHome']);
Route::post('/login', [LoginController::class, 'postLogin']);
Route::get('/logout', [LogoutController::class, 'logout']);


Route::prefix('admin')->group(function () {
    Route::get('/', [MainController::class, 'index']);
    Route::get('/add', [MainController::class, 'add']);
    //Route::get('/edit', [MainController::class, 'edit']);

    Route::post('/add', [MainController::class, 'add']);
    Route::get('/edit/{profileId}', [MainController::class, 'edit']);
    Route::post('/update', [MainController::class, 'update']);
    Route::get('/del/{profileId}', [MainController::class, 'del']);
});

//Route::get('/admin', [MainController::class, 'index']);