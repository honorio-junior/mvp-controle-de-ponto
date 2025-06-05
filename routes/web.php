<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminPainelMiddleware;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::view('/login', 'login')->name('login');
Route::post('/login',[LoginController::class, 'authenticate'])->name('login');

Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/point', [PointController::class, 'register'])->name('point');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware(AdminPainelMiddleware::class);
    Route::get('/admin-download-records', [AdminController::class, 'records'])->name('admin.download.records')->middleware(AdminPainelMiddleware::class);
    Route::post('/admin-users-create', [AdminController::class, 'userCreate'])->name('admin.users.create')->middleware(AdminPainelMiddleware::class);
    Route::delete('/admin-users-destroy/{id}', [AdminController::class, 'userDestroy'])->name('admin.users.destroy')->middleware(AdminPainelMiddleware::class);
    Route::get( '/getTime', function () {
        return json_encode(['datetime' => date('d/m/Y H:i:s')]);
    })->name('getTime');
});
