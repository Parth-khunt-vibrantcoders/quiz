<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\frontend\LoginController as UserloginController;
use App\Http\Controllers\frontend\QuizLoginController;


use Illuminate\Support\Facades\Artisan;

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

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    echo "Cache is cleared<br>";
    Artisan::call('route:clear');
    echo "route cache is cleared<br>";
    Artisan::call('config:clear');
    echo "config is cleared<br>";
    Artisan::call('view:clear');
    echo "view is cleared<br>";
});

Route::get('admin-login', [LoginController::class, 'admin_login'])->name('admin-login');
Route::post('check-login', [LoginController::class, 'check_login'])->name('check-login');

Route::get('sign-in', [UserloginController::class, 'login'])->name('sign-in');
Route::post('check-sign-in', [UserloginController::class, 'check_sign_in'])->name('check-sign-in');

Route::get('sign-up', [UserloginController::class, 'sign_up'])->name('sign-up');
Route::post('save-sign-up', [UserloginController::class, 'save_sign_up'])->name('save-sign-up');

Route::get('/', [QuizLoginController::class, 'list'])->name('home');
