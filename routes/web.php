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
    Route::post('/staffs/create',[StaffController::class, 'store'])->name('staffs.store');
    Route::get('/staffs/delete/{id}',[StaffController::class, 'delete'])->name('staffs.delete');
    Route::get('/staffs/{id}',[StaffController::class, 'detail'])->name('staffs.detail');
    Route::put('/staffs/{id}',[StaffController::class, 'update'])->name('staffs.update');

    
    // Clients
    Route::get('/clients',[ClientController::class, 'index'])->name('clients');
    Route::get('/clients/create',[ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients/create',[ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/delete/{id}',[ClientController::class, 'delete'])->name('clients.delete');
    Route::get('/clients/{id}',[ClientController::class, 'detail'])->name('clients.detail');
    Route::put('/clients/{id}',[ClientController::class, 'update'])->name('clients.update');

    //Departments
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments/create', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/delete/{id}', [DepartmentController::class, 'delete'])->name('departments.delete');
    Route::get('/departments/{id}', [DepartmentController::class, 'detail'])->name('departments.detail');
    Route::put('/departments/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    
    //Admin
    Route::get('/admins', [AdminController::class, 'index'])->name('admins');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/admins/create',[AdminController::class, 'store'])->name('admins.store');
    Route::get('/admins/delete/{id}',[AdminController::class, 'delete'])->name('admins.delete');
    Route::get('/admins/{id}', [AdminController::class, 'detail'])->name('admins.detail');
    Route::put('/admins/{id}',[AdminController::class, 'update'])->name('admins.update');

    
    //Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

});

require __DIR__.'/auth.php';
