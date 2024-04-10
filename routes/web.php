<?php

use App\Http\Controllers\GuidanceController;
use App\Http\Controllers\HeadOfDepartementController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('/lecturer', LecturerController::class)->names('dashboard.lecturer');
    Route::resource('/student', StudentController::class)->names('dashboard.student');
    Route::resource('/kajur', HeadOfDepartementController::class)->names('dashboard.kajur');
    Route::resource('/bimbingan', GuidanceController::class)->names('dashboard.bimbingan');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
