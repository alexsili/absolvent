<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SchoolClassController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);


Route::middleware(['auth:sanctum', 'director'])->group(function () {
    // School Classes Routes
    Route::post('school-classes', [SchoolClassController::class, 'store']);
    Route::post('school-classes/{schoolClass}', [SchoolClassController::class, 'update']);
    Route::delete('school-classes/{schoolClass}', [SchoolClassController::class, 'destroy']);

    // Students Routes
    Route::post('students', [StudentController::class, 'store']);
    Route::post('students/{student}', [StudentController::class, 'update']);
    Route::delete('students/{student}', [StudentController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'checkRole'])->group(function () {
    // School Classes Routes
    Route::get('school-classes', [SchoolClassController::class, 'index']);
    Route::get('school-classes/{schoolClass}', [SchoolClassController::class, 'show']);

    // Students Routes
    Route::get('students', [StudentController::class, 'index']);
    Route::get('students/{student}', [StudentController::class, 'show']);
});
