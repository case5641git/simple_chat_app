<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\MessageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('web');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('web');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/delete', [AuthController::class, 'delete'])->name('delete');

Route::post('/messages', [MessageController::class, 'store']);
