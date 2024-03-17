<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\TeacherHomeAPIController;
use App\Http\Controllers\API\StudentHomeAPIController;
use App\Http\Controllers\API\ActivityAPIController;
use App\Http\Controllers\API\SubjectAPIController;
use App\Http\Controllers\API\ClassRoomAPIController;
use App\Http\Controllers\API\StudentAPIController;
use App\Http\Controllers\API\TeacherAPIController;
use App\Http\Controllers\API\CountryAPIController;
use App\Http\Controllers\API\ProfileAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

//Teacher
//Bearer 5|edHQpuheCEmyGxS82u9LqRXCPdGaLX9xyMJKnGAVa18eb030
Route::get('/student-list', [TeacherHomeAPIController::class, 'index']);
Route::put('/student-list/student/{studentId}/activity/{activityId}', [TeacherHomeAPIController::class, 'updateStudentScore']);

//Student
//3|CENLL5d01KqL057PIB1uljBBLrkU8QxgazqFjFOw74072ccf
Route::get('/activity-list', [StudentHomeAPIController::class, 'index']);

//Admin
//Bearer 4|sShblhsnuyzrOjbkqFHDCBRKDeJLqfIr83BzsPOdc4165725
Route::apiResource('activities', ActivityAPIController::class);
Route::apiResource('subjects', SubjectAPIController::class);
Route::apiResource('classes', ClassRoomAPIController::class);
Route::apiResource('students', StudentAPIController::class);
Route::apiResource('teachers', TeacherAPIController::class);
Route::get('countries', [CountryAPIController::class, 'index']);

//Profile
Route::get('/profile', [ProfileAPIController::class, 'index']);
Route::put('/profile', [ProfileAPIController::class, 'update']);
