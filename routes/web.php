<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('students', StudentController::class);
Route::resource('courses', StudentController::class);
Route::get('students/{studentModel}/manage-courses', [StudentModelController::class, 'manageCourses'])->name('students.manageCourses');
Route::post('students/{studentModel}/update-courses', [StudentModelController::class, 'updateCourses'])->name('students.updateCourses');

