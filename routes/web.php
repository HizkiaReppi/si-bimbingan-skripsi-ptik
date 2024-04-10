<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuidanceActivityController;
use App\Http\Controllers\GuidanceController;
use App\Http\Controllers\HeadOfDepartementController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetGuidanceController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/lecturer', LecturerController::class)->names('dashboard.lecturer');
    Route::resource('/student', StudentController::class)->names('dashboard.student');
    Route::resource('/kajur', HeadOfDepartementController::class)->names('dashboard.kajur');
    Route::resource('/bimbingan', GuidanceController::class)->names('dashboard.bimbingan');

    Route::get('/atur-jadwal-bimbingan', [SetGuidanceController::class, 'index'])->name('dashboard.atur-jadwal-bimbingan.index');
    Route::get('/atur-jadwal-bimbingan/{atur_jadwal_bimbingan}', [SetGuidanceController::class, 'show'])->name('dashboard.atur-jadwal-bimbingan.show');
    Route::put('/atur-jadwal-bimbingan/{atur_jadwal_bimbingan}', [SetGuidanceController::class, 'update'])->name('dashboard.atur-jadwal-bimbingan.update');

    Route::get('/aktivitas-bimbingan', [GuidanceActivityController::class, 'index'])->name('dashboard.aktivitas-bimbingan.index');
    Route::get('/aktivitas-bimbingan/{aktivitas_bimbingan}', [GuidanceActivityController::class, 'show'])->name('dashboard.aktivitas-bimbingan.show');
    Route::get('/aktivitas-bimbingan/{aktivitas_bimbingan}/edit', [GuidanceActivityController::class, 'edit'])->name('dashboard.aktivitas-bimbingan.edit');
    Route::put('/aktivitas-bimbingan/{aktivitas_bimbingan}', [GuidanceActivityController::class, 'update'])->name('dashboard.aktivitas-bimbingan.update');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
