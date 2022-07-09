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
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::group(['middleware' => 'auth'], function(){
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Staffs
    Route::get('/staffs',[StaffController::class, 'index'])->name('staffs');
    Route::get('/staffs/create',[StaffController::class, 'create'])->name('staffs.create');
    Route::get('/staffs/{id}',[StaffController::class, 'detail'])->name('staffs.detail');
    
    // Clients
    Route::get('/clients',[ClientController::class, 'index'])->name('clients');
    Route::get('/clients/create',[ClientController::class, 'create'])->name('clients.create');
    Route::get('/clients/{id}',[ClientController::class, 'detail'])->name('clients.detail');

    //Departments
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::get('/departments/{id}', [DepartmentController::class, 'detail'])->name('departments.detail');

    //Admin
    Route::get('/admins', [AdminController::class, 'index'])->name('admins');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::get('/admins/{id}', [AdminController::class, 'detail'])->name('admins.detail');
    
    //Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

});

require __DIR__.'/auth.php';
