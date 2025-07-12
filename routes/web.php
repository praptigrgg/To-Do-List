<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/home', [TaskController::class, 'home'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])->name('otp.verify.form');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');;
});
Route::middleware('guest')->group(function () {
    Route::get('/password/forgot', [AuthController::class, 'showForgotForm'])
        ->name('password.request');
    Route::post('/password/forgot', [AuthController::class, 'sendForgotOtp'])->name('password.email');

    Route::get('/password/reset', [AuthController::class, 'showResetForm'])
        ->name('password.reset.form');
    Route::post('/password/reset', [AuthController::class, 'resetPassword'])
        ->name('password.update');
});

Route::middleware('auth')->group(function () {

    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

});

Route::middleware(['auth'])->group(function () {

Route::get('/admin-dashboard/users', [AdminDashboardController::class, 'user'])->name('amdin.dashboard.users');
Route::get('/admin-dashboard/roles', [AdminDashboardController::class, 'manageRoles'])->name('admin.dashboard.roles');
Route::post('/admin-dashboard/roles/update/{user}', [AdminDashboardController::class, 'updateRole'])->name('admin.dashboard.roles.update');
});
