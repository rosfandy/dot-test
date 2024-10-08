<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Room;
use App\Http\Controllers\Student;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::post('login', [Auth\PagesController::class, 'adminLogin'])->name('auth.admin.login');
    Route::post('logout', [Auth\PagesController::class, 'adminLogout'])->name('auth.admin.logout');
});

Route::get('/login', [PagesController::class, 'login'])->name('login');

Route::group(['middleware' => ['verifyAdmin']], function () {
    Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('pages.dashboard');
    Route::prefix('room')->group(function () {
        Route::get('store', [Room\PagesController::class, 'store'])->name('pages.room.store');
        Route::get('edit', [Room\PagesController::class, 'edit'])->name('pages.room.edit');
    });
    Route::prefix('student')->group(function () {
        Route::get('store', [Student\PagesController::class, 'store'])->name('pages.student.store');
        Route::get('edit', [Student\PagesController::class, 'edit'])->name('pages.student.edit');
    });
});
