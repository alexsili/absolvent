<?php

use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::middleware(['auth:sanctum', 'director'])->group(function () {
    // School Classes Routes
    Route::get('school-classes', [SchoolClassController::class, 'create'])->name('schoolClass.create');
    Route::post('school-classes', [SchoolClassController::class, 'store'])->name('schoolClass.store');
    Route::get('{schoolClass}/school-classes', [SchoolClassController::class, 'edit'])->name('schoolClass.edit');
    Route::post('school-classes/{schoolClass}', [SchoolClassController::class, 'update'])->name('schoolClass.update');
    Route::delete('school-classes/{schoolClass}', [SchoolClassController::class, 'destroy'])->name('schoolClass.destroy');

    // Students Routes
    Route::get('{schoolClass}/students', [StudentController::class, 'create'])->name('students.create');
    Route::post('{schoolClass}/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('{schoolClass}/students/{student}', [StudentController::class, 'edit'])->name('students.edit');
    Route::post('students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
});

Route::middleware(['auth:sanctum', 'checkRole'])->group(function () {
    // School Classes Routes
    Route::get('/', [SchoolClassController::class, 'index'])->name('home');
    Route::get('school-classes/{schoolClass}', [SchoolClassController::class, 'show'])->name('show');

    // Students Routes
    Route::get('students', [StudentController::class, 'index']);
    Route::get('students/{student}', [StudentController::class, 'show']);
});
