<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });



use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth', 'role:Admin|Academic Head'])->group(function () {
//     Route::post('/courses/create', [CourseController::class, 'store']);
//     Route::post('/modules/create', [ModuleController::class, 'store']);
//     Route::put('/modules/update/{module}', [ModuleController::class, 'update']);
//     Route::delete('/modules/delete/{module}', [ModuleController::class, 'delete']);
// });


Route::middleware(['auth', 'role:Admin|Academic Head'])->group(function () {
    Route::post('/courses/create', [CourseController::class, 'store']);
    Route::put('/courses/update/{course}', [CourseController::class, 'update']);
    Route::delete('/courses/delete/{course}', [CourseController::class, 'delete']);
});
