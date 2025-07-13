<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])->name('otp.verify.form');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');

    Route::get('/password/forgot', [AuthController::class, 'showForgotForm'])->name('password.request');
    Route::post('/password/forgot', [AuthController::class, 'sendForgotOtp'])->name('password.email');

    Route::get('/password/reset', [AuthController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [TaskController::class, 'home'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/task-dashboard/dashboard', [TaskController::class, 'dashboard'])->name('tasks.dashboard');
Route::get('/tasks', [TaskController::class, 'dashboard'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');     // <-- ADD THIS
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');


    Route::prefix('admin-dashboard')->name('admin.dashboard.')->group(function () {
        Route::get('/users', [AdminDashboardController::class, 'user'])->name('users');
        Route::get('/roles', [AdminDashboardController::class, 'manageRoles'])->name('roles');
        Route::post('/roles/update/{user}', [AdminDashboardController::class, 'updateRole'])->name('roles.update');
    });

    Route::prefix('admin/users')->name('admin.users.')->group(function () {
        Route::get('/create', [AdminDashboardController::class, 'createUserForm'])->name('create');
        Route::post('/', [AdminDashboardController::class, 'storeUser'])->name('store');
        Route::get('/{user}/edit', [AdminDashboardController::class, 'editUser'])->name('edit');
        Route::put('/{user}', [AdminDashboardController::class, 'updateUser'])->name('update');
        Route::delete('/{user}', [AdminDashboardController::class, 'deleteUser'])->name('delete');
    });

    Route::prefix('admin/roles')->name('admin.roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('/{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role}', [RoleController::class, 'delete'])->name('delete');
    });
});
