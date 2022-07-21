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
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskController;

Route::group(['middleware' => ['auth','prevent-back-history']], function(){
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => 'role:1'], function() {
        // Staffs
        Route::get('/staffs',[StaffController::class, 'index'])->name('staffs');
        Route::get('/staffs/create',[StaffController::class, 'create'])->name('staffs.create');
        Route::post('/staffs/create',[StaffController::class, 'store'])->name('staffs.store');
        Route::get('/staffs/delete/{id}',[StaffController::class, 'delete'])->name('staffs.delete');
        Route::get('/staffs/{id}',[StaffController::class, 'detail'])->name('staffs.detail');
        Route::put('/staffs/{id}',[StaffController::class, 'update'])->name('staffs.update');

        //Admin
        Route::get('/admins', [AdminController::class, 'index'])->name('admins');
        Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
        Route::post('/admins/create',[AdminController::class, 'store'])->name('admins.store');
        Route::get('/admins/delete/{id}',[AdminController::class, 'delete'])->name('admins.delete');
        Route::get('/admins/{id}', [AdminController::class, 'detail'])->name('admins.detail');
        Route::put('/admins/{id}',[AdminController::class, 'update'])->name('admins.update');
        
        //Departments
        Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
        Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
        Route::post('/departments/create', [DepartmentController::class, 'store'])->name('departments.store');
        Route::get('/departments/delete/{id}', [DepartmentController::class, 'delete'])->name('departments.delete');
        Route::get('/departments/{id}', [DepartmentController::class, 'detail'])->name('departments.detail');
        Route::put('/departments/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    });

    Route::group(['middleware' => 'role:1,2'], function() {
        // Clients
        Route::get('/clients',[ClientController::class, 'index'])->name('clients');
        Route::get('/clients/create',[ClientController::class, 'create'])->name('clients.create');
        Route::post('/clients/create',[ClientController::class, 'store'])->name('clients.store');
        Route::get('/clients/delete/{id}',[ClientController::class, 'delete'])->name('clients.delete');
        Route::get('/clients/{id}',[ClientController::class, 'detail'])->name('clients.detail');
        Route::put('/clients/{id}',[ClientController::class, 'update'])->name('clients.update');
       
        Route::get('/projects/tasks/{id}',[TaskController::class, 'index'])->name('tasks');
        Route::get('/projects/tasks/{id}/create',[TaskController::class,'create'])->name('tasks.create');
        Route::post('/projects/tasks/{id}/create',[TaskController::class,'store'])->name('tasks.store');
        Route::get('/tasks/{id}',[TaskController::class,'detail'])->name('tasks.detail');
        Route::get('/tasks/delete/{id}',[TaskController::class,'delete'])->name('tasks.delete');
        // Route::put('/tasks/{$id}',[TaskController::class,'update'])->name('tasks.update');
    });

    //Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    //Project
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
    Route::get('/projects/create',[ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects/create',[ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/delete/{id}',[ProjectController::class, 'delete'])->name('projects.delete');
    Route::get('/projects/{id}',[ProjectController::class, 'detail'])->name('projects.detail');
    Route::put('/projects/{id}',[ProjectController::class, 'update'])->name('projects.update');

    //Report
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
});

require __DIR__.'/auth.php';
