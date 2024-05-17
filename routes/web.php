<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('resources/views/user/home_page/main.blade.php', function () {
//     return view('/main.blade.php');
// });

Route::get("/login", [AuthController::class, "login"]);

Route::get("/logout", [AuthController::class, "logout"]);

Route::get("/login/google/callback", [AuthController::class, "handleGoogleCallback"]);

Route::get("/test", [AuthController::class, "test"]);

Route::prefix('user')->group(function () {
    Route::get('/resources/views/user/home_page/main.blade.php', [UserController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

});

Route::prefix('admin')->group(function () {
    Route::get('/resources/views/admin/dashboard_admin.blade.php', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');

});