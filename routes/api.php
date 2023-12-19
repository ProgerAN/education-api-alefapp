<?php

use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\LectureController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('students')->controller(StudentController::class)->group(function () {
    Route::get('', 'index');
    Route::post('', 'store');
    Route::get('{student}', 'show');
    Route::put('{student}', 'update');
    Route::delete('{student}', 'destroy');
});

Route::prefix('classrooms')->controller(ClassroomController::class)->group(function () {
    Route::get('', 'index');
    Route::get('{classroom}/getInfo', 'showInfo');
    Route::post('', 'store');
    Route::post('{classroom}/updateName', 'updateName');

    Route::get('{classroom}/getLectures', 'showLectures');
    Route::put('{classroom}/updatePlan', 'updatePlan');

    Route::delete('{classroom}', 'destroy');
});

Route::prefix('lectures')->controller(LectureController::class)->group(function () {
    Route::get('', 'index');
    Route::post('', 'store');
    Route::get('{lecture}', 'show');
    Route::put('{lecture}', 'update');
    Route::delete('{lecture}', 'destroy');
});

Route::fallback(function (){
    //return \MarcinOrlowski\ResponseBuilder\ResponseBuilder::error(404);
    //ResourceBundle::success();
    abort(404, 'API resource not found');
});
