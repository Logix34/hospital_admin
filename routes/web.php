<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/app', function () {
    return view('admin/layouts/app');
});
Route::get('/login',[AdminController::class,'getLogin'])->name('login');
Route::post('/verify-login',[AdminController::class,'postLogin']);
Route::post('/submit-doctors/form',[UserController::class,'createDoctor']);
Route::put('/submit-Profile/form', [AdminController::class,'updateProfile'])->name('admin.updateProfile');

Route::group(['middleware' => 'auth'], function () {
//////////////////////////.........Admin Type .....Users section......../////////////////////
   Route::get('/admin/dashboard',[AdminController::class,'dashboard']);
    Route::get('/User/profile', [AdminController::class,'editprofile'])->name('admin.profile');
    Route::get('/admin/get-users',[UserController::class,'index']);
    Route::get('/get-users/list', [UserController::class,'getUserListing']);
    Route::get('/get-users/add',[UserController::class,'getAdd']);
    Route::get('/users/edit/{id}',  [UserController::class,'edit']);
//////////////////////////.........Admin Type .....Patients section......../////////////////////
    Route::get('/admin/get-patients',[PatientController::class,'getIndex']);
//////////////////////////.........Users section Doctor......../////////////////////
    Route::get('/doctor/dashboard',[AdminController::class,'getDashboard']);




});
Route::get('/logout', [AdminController::class,'logoutUser']);
