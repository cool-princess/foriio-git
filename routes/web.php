<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogInController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\UserRegistrationController;
use App\Http\Controllers\User\ContractController;

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

Auth::routes();

Route::get('/logout', [LogoutController::class,'userLogout'])->name('userLogout');

Route::group(['middleware' => 'auth:user'], function () {
    Route::view('/user', 'user');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin');
});

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showUserLoginForm'])->name('showUserLoginForm');
Route::post('/login', [LoginController::class,'userLogin'])->name('userLoginPost');
Route::get('/logout', [LogoutController::class,'userLogout'])->name('userLogout');

Route::get('/register', [UserRegistrationController::class,'show'])->name('userRegister');
Route::post('/register', [UserRegistrationController::class,'store'])->name('userRegisterPost');
Route::get('/register_complete', [UserRegistrationController::class,'complete'])->name('userRegisterComplete');

Route::get('/contract', [ContractController::class, 'show'])->name('userContract');
Route::get('/contract_confirm', [ContractController::class, 'confirm'])->name('userContractConfirm');
Route::post('/quiz', [ContractController::class,'quiz'])->name('userContractQuiz');
Route::get('/benefit', [ContractController::class, 'benefit'])->name('userBenefit');
Route::post('/benefit', [ContractController::class, 'benefitPost'])->name('userBenefitPost');
Route::post('/benefit_quiz', [ContractController::class,'benefit_quiz'])->name('userBenefitQuiz');
Route::get('/desire_date', [ContractController::class, 'desire_date'])->name('userDesired');
Route::post('/desire_date', [ContractController::class,'datePost'])->name('userDatePost');
Route::get('/report', [ContractController::class, 'report'])->name('userReport');
Route::post('/report', [ContractController::class,'reportPost'])->name('userReportPost');
Route::post('/report_quiz', [ContractController::class,'report_quiz'])->name('userReportQuiz');
Route::get('/all_complete', [ContractController::class, 'all_complete'])->name('userAllComplete');
Route::get('/admin/manage', [ContractController::class, 'manage'])->name('adminManage');
Route::post('/admin/manage', [ContractController::class, 'managePost'])->name('adminManagePost');
