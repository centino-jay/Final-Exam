<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;

Route::apiResource('students', StudentController::class);
Route::apiResource('students.subjects', SubjectController::class);
