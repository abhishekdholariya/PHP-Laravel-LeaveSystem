<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Reportcontroller;

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

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'] )->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // ####### user routes #######
    Route::resource('user', UserController::class);
    // ####### department routes #######
    Route::resource('department', DepartmentController::class);
    // ####### leave routes #######
    Route::resource('leave', LeaveController::class);
    Route::get('/leave/myleave', [LeaveController::class, 'myLeave'])->name('leave.myleave');
    Route::get('/leave/approve/{id}', [LeaveController::class, 'approve'])->name('leave.approve');
    Route::get('/leave/reject/{id}', [LeaveController::class, 'reject'])->name('leave.reject');
    Route::get('approved', [LeaveController::class, 'approved'])->name('leave.approved');
    Route::get('rejected', [LeaveController::class, 'rejected'])->name('leave.rejected');
    // leave.requesting
    Route::get('leave/0/requesting', [LeaveController::class, 'requesting'])->name('leave.requesting');
    Route::get('report/waiting',[Reportcontroller::class,'waiting'])->name('report.waiting');
    Route::get('report/approved',[Reportcontroller::class,'approved'])->name('report.approved');
    Route::get('report/rejected',[Reportcontroller::class,'rejected'])->name('report.rejected');
});

require __DIR__ . '/auth.php';
