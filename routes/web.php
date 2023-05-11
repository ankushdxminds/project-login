<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\LoginController;
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
Route::get('/', [LoginController::class, 'login']);

Route::group(['middleware' => 'UnAuthAdmin'], function ()
{
    Route::get('/login', [LoginController::class, 'login_view']);
    Route::post('/login-api', [LoginController::class, 'login_api']);
});

Route::group(['prefix' => 'admin'], function ()
{
    Route::get('/logout', [LoginController::class, 'logout']);

    Route::group(['middleware' => 'AdminAuth'], function ()
    {
        Route::get('/dashboard', [DashboardController::class, 'dashboard_view']);
        
        Route::group(['prefix' => 'user'], function ()
        {
            Route::get('/list', [UserController::class, 'user_list_view']);
            Route::get('/add', [UserController::class, 'add_user_view']);
            Route::get('/edit/{user_id}', [UserController::class, 'edit_user_view']);
            Route::post('/search-api', [UserController::class, 'search_user_api']);
            Route::post('/store-api', [UserController::class, 'store_user_api']);
            Route::post('/update-api', [UserController::class, 'update_user_api']);
        });
     
    });
});

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/check-login', [LoginController::class, 'check_login']);