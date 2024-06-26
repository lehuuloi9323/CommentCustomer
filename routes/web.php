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




Route::get('admin/login', [App\Http\Controllers\AuthController::class, 'login_admin'])->name('login_admin');
Route::post('admin/login/action', [App\Http\Controllers\AuthController::class, 'login_admin_action'])->name('login_admin_action');


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
    Route::post('/admin/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('admin_user_create');
    Route::get('/admin/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('admin_user_edit');
    Route::post('/admin/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin_user_update');
    Route::get('/admin/user/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('admin_user_delete');
    Route::get('/admin/user/action', [App\Http\Controllers\UserController::class, 'action'])->name('admin_user_action');


    Route::get('/admin/restaurant', [App\Http\Controllers\RestaurantController::class, 'index'])->name('admin_restaurant_list');
    Route::get('/admin/restaurant/add', [App\Http\Controllers\RestaurantController::class, 'add'])->name('admin_restaurant_add');
    Route::post('/admin/restaurant/add', [App\Http\Controllers\RestaurantController::class, 'insert'])->name('admin_restaurant_insert');
    Route::get('/admin/restaurant/edit/{id}', [App\Http\Controllers\RestaurantController::class, 'edit'])->name('admin_restaurant_edit');
    Route::post('/admin/restaurant/update/{id}', [App\Http\Controllers\RestaurantController::class, 'update'])->name('admin_restaurant_update');
    Route::get('/admin/restaurant/delete/{id}', [App\Http\Controllers\RestaurantController::class, 'delete'])->name('admin_restaurant_delete');
    Route::get('/admin/area', [App\Http\Controllers\AreaController::class, 'index'])->name('admin_area_list');
    Route::get('/admin/area/add', [App\Http\Controllers\AreaController::class, 'add'])->name('admin_area_add');
    Route::post('/admin/area/insert', [App\Http\Controllers\AreaController::class, 'insert'])->name('admin_area_insert');
    Route::get('/admin/area/edit/{id}', [App\Http\Controllers\AreaController::class, 'edit'])->name('admin_area_edit');
    Route::post('/admin/area/update/{id}', [App\Http\Controllers\AreaController::class, 'update'])->name('admin_area_update');
    Route::get('/admin/area/delete/{id}', [App\Http\Controllers\AreaController::class, 'delete'])->name('admin_area_delete');
    Route::get('/admin/rate', [App\Http\Controllers\RateController::class, 'index'])->name('admin_rate');

    Route::get('/admin/permission/add', [App\Http\Controllers\PermissionController::class, 'add'])->name('permission.add');
    Route::post('/admin/permission/storeadd', [App\Http\Controllers\PermissionController::class, 'storeadd'])->name('permission.storeadd');
    Route::get('/admin/permission/edit/{id}', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('/admin/permission/update/{id}', [App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update');
    Route::get('/admin/permission/delete/{id}', [App\Http\Controllers\PermissionController::class, 'delete'])->name('permission.delete');

    Route::get('/admin/role/add', [App\Http\Controllers\RoleController::class, 'add'])->name('role.add');
    Route::post('admin/role/store', [App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
    Route::get('/admin/role/list', [App\Http\Controllers\RoleController::class, 'list'])->name('role.list');
    Route::get('admin/role/edit/{role}', [App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit');
    Route::post('admin/role/update/{role}', [App\Http\Controllers\RoleController::class, 'update'])->name('role.update');
    Route::get('admin/role/delete/{role}', [App\Http\Controllers\RoleController::class, 'delete'])->name('role.delete');
});
Route::get('/create_user', [App\Http\Controllers\UserController::class, 'createtest'])->name('create_user');



// Route::get('/register', function(){
//    return view('auth.register');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
