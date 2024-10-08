<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|------------------------------------------ --------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});

Route::get('rooms', [RoomController::class, 'get'])->name('room.get');
Route::get('students', [StudentController::class, 'get'])->name('student.get');

Route::group(['middleware' => ['jwt.admin']], function () {
    Route::prefix('rooms')->group(function () {
        Route::post('store', [RoomController::class, 'store'])->name('room.store');
        Route::put('update/{id}', [RoomController::class, 'update'])->name('room.update');
        Route::delete('destroy/{id}', [RoomController::class, 'destroy'])->name('room.destroy');
    });

    Route::prefix('students')->group(function () {
        Route::post('store', [StudentController::class, 'store'])->name('student.store');
        Route::put('update/{id}', [StudentController::class, 'update'])->name('student.update');
        Route::delete('destroy/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
    });
});
