<?php

use App\Http\Controllers\Auth\LogInController;
use App\Http\Controllers\Adminpage\AdminRegistrationController;
use App\Http\Controllers\Adminpage\UserRegistrationController;
use Illuminate\Support\Facades\Route;

// Route::group(['middleware' => ['auth']], function() {
//     Route::get('/admin', [LogInController::class, 'showAdminLoginForm'])->name('adminLoginShow');

//     Route::get('admin', [LogInController::class, 'adminLogin'])->name('adminLoginPost');
// });
// Route::get('admin/login', [App\Http\Controllers\AuthenticatedSessionController::class, 'create'])->name('adminLogin');
// Route::post('admin/login', [App\Http\Controllers\AuthenticatedSessionController::class, 'store'])->name('adminLoginPost');

// Route::get('/admin/register', [App\Http\Controllers\AdminPage\AdminRegistrationController::class, 'show'])->name('adminRegister');
// Route::post('/admin/register', [App\Http\Controllers\AdminPage\AdminRegistrationController::class, 'store'])->name('adminRegisterPost');

// Route::get('/admin/user_register', [App\Http\Controllers\AdminPage\UserRegistrationController::class, 'index'])->name('userRegister');
// Route::post('/admin/user_register', [App\Http\Controllers\AdminPage\UserRegistrationController::class, 'store'])->name('userRegisterPost');

// Route::group(['middleware' => ['auth']], function() {
    
//     Route::get('/logout', [App\Http\Controllers\LogoutController::class, 'perform'])->name('adminLogout');
// });


