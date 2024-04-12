<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\GuidanceActivityController;
use App\Http\Controllers\GuidanceController;
use App\Http\Controllers\GuidedStudentController;
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
    Route::get('/bimbingan', [GuidanceController::class, 'index'])->name('dashboard.bimbingan.index');
    Route::resource('/ujian', ExamResultController::class)->names('dashboard.ujian');

    Route::get('/bimbingan/dosen-pembimbing-1', [GuidanceController::class, 'index'])->name('dashboard.bimbingan-1.index');
    Route::get('/bimbingan/dosen-pembimbing-1/create', [GuidanceController::class, 'create'])->name('dashboard.bimbingan-1.create');
    Route::post('/bimbingan/dosen-pembimbing-1', [GuidanceController::class, 'store'])->name('dashboard.bimbingan-1.store');
    Route::get('/bimbingan/dosen-pembimbing-1/{bimbingan}', [GuidanceController::class, 'show'])->name('dashboard.bimbingan-1.show');
    Route::get('/bimbingan/dosen-pembimbing-1/{bimbingan}/edit', [GuidanceController::class, 'edit'])->name('dashboard.bimbingan-1.edit');
    Route::put('/bimbingan/dosen-pembimbing-1/{bimbingan}', [GuidanceController::class, 'update'])->name('dashboard.bimbingan-1.update');
    Route::delete('/bimbingan/dosen-pembimbing-1/{bimbingan}', [GuidanceController::class, 'destroy'])->name('dashboard.bimbingan-1.destroy');

    Route::get('/bimbingan/dosen-pembimbing-2', [GuidanceController::class, 'index'])->name('dashboard.bimbingan-2.index');
    Route::get('/bimbingan/dosen-pembimbing-2/create', [GuidanceController::class, 'create'])->name('dashboard.bimbingan-2.create');
    Route::post('/bimbingan/dosen-pembimbing-2', [GuidanceController::class, 'store'])->name('dashboard.bimbingan-2.store');
    Route::get('/bimbingan/dosen-pembimbing-2/{bimbingan}', [GuidanceController::class, 'show'])->name('dashboard.bimbingan-2.show');
    Route::get('/bimbingan/dosen-pembimbing-2/{bimbingan}/edit', [GuidanceController::class, 'edit'])->name('dashboard.bimbingan-2.edit');
    Route::put('/bimbingan/dosen-pembimbing-2/{bimbingan}', [GuidanceController::class, 'update'])->name('dashboard.bimbingan-2.update');
    Route::delete('/bimbingan/dosen-pembimbing-2/{bimbingan}', [GuidanceController::class, 'destroy'])->name('dashboard.bimbingan-2.destroy');

    Route::get('/mahasiswa-bimbingan', [GuidedStudentController::class, 'index'])->name('dashboard.mahasiswa-bimbingan.index');
    Route::get('/mahasiswa-bimbingan/{mahasiswa_bimbingan}', [GuidedStudentController::class, 'show'])->name('dashboard.mahasiswa-bimbingan.show');

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
