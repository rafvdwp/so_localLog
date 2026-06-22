<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LogController::class, 'index'])->name('logs.index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');