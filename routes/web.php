<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherHomeController;
use App\Http\Controllers\StudentHomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/home/teacher', [TeacherHomeController::class, 'index'])->name('teachers.home');
Route::get('/home/teacher/list', [TeacherHomeController::class, 'list'])->name('teachers.home.list');
Route::get('/home/teacher/student/{studentId}/activity/{activityId}', [TeacherHomeController::class, 'editStudentScore'])
    ->name('teachers.edit-student-score');
Route::put('/home/teacher/student/{studentId}/activity/{activityId}', [TeacherHomeController::class, 'updateStudentScore'])
    ->name('teachers.update-student-score');

Route::get('/home/student', [StudentHomeController::class, 'index'])->name('students.home');
Route::get('/home/student/list', [StudentHomeController::class, 'list'])->name('students.home.list');


Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
