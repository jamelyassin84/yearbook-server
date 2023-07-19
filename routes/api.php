<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\SchoolAdminController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\YearbookController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {
Route::post('auth/logout', [AuthController::class, 'logout']);
Route::post('file', [FileController::class, 'upload']);

Route::resource('students', StudentController::class);
Route::get('students-get-year-book', [StudentController::class, 'getYearbook']);

Route::resource('faculties', FacultyController::class);
Route::get('faculties-get-year-book', [FacultyController::class, 'getYearbook']);

Route::resource('staffs', StaffController::class);
Route::get('staffs-get-year-book', [StaffController::class, 'getYearbook']);

Route::resource('school-admins', SchoolAdminController::class);
Route::get('school-admins-get-year-book', [SchoolAdminController::class, 'getYearbook']);

Route::resource('admins', AdminController::class);
Route::resource('events', EventController::class);
Route::resource('courses', CourseController::class);
Route::resource('sections', SectionController::class);
Route::resource('yearbooks', YearbookController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('information', InformationController::class);
Route::resource('school-years', SchoolYearController::class);
// });
