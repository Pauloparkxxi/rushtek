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
use App\Http\Controllers\StaffsController;
// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function(){
    // Dashboard
    Route::get('/', function () {
        return view('dashboard');
    })->name('index');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Staffs
    Route::get('/staffs',[StaffsController::class, 'index'])->name('staffs');
});

require __DIR__.'/auth.php';
