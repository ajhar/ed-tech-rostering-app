<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ClassRoomController;


Route::get('teachers/list', [TeacherController::class, 'list'])->name('teachers.list');
Route::resource('teachers', TeacherController::class);

Route::get('students/list', [StudentController::class,'list'])->name('students.list');
Route::resource('students', StudentController::class);

Route::get('classes/list', [ClassRoomController::class, 'list'])->name('classes.list');
Route::resource('classes', ClassRoomController::class);

Route::get('subjects/list', [SubjectController::class, 'list'])->name('subjects.list');
Route::resource('subjects', SubjectController::class);

Route::get('activities/list', [ActivityController::class, 'list'])->name('activities.list');
Route::resource('activities', ActivityController::class);


