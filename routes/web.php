<?php

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

// Route::get('/', function () {
//     return view('login');
// });




Route::get('login/admin', [App\Http\Controllers\AuthController::class, 'login_admin'])->name('login_admin');
Route::post('login/admin/action', [App\Http\Controllers\AuthController::class, 'login_admin_action'])->name('login_admin_action');


Route::get('/', [App\Http\Controllers\AuthController::class, 'showLoginForm']);
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('loginForm');
Route::post('/login_handle', [App\Http\Controllers\AuthController::class, 'login'])->name('login_handle');
//     Route::get('/rate', [App\Http\Controllers\DataController::class, 'index'])->name('rate');
// Route::get('admin/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('auth')->group(function(){

    Route::get('/rate', [App\Http\Controllers\DataController::class, 'index'])->name('rate');
    Route::post('/rate/action', [App\Http\Controllers\DataController::class, 'action'])->name('rate_action');


});
//admin
Route::middleware('admin.auth')->group(function(){
    Route::get('/admin/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/user', [App\Http\Controllers\UserController::class, 'list'])->name('admin_user_list');
    Route::get('/admin/add', [App\Http\Controllers\UserController::class, 'add'])->name('admin_user_add');
    Route::post('/admin/create', [App\Http\Controllers\UserController::class, 'create'])->name('admin_user_create');

});
Route::get('/create_user', [App\Http\Controllers\UserController::class, 'createtest'])->name('create_user');



// Route::get('/register', function(){
//    return view('auth.register');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
