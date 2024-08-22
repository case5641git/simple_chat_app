<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ChannelController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('web');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('web');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/delete', [AuthController::class, 'delete'])->name('delete');

Route::post('/messages', [MessageController::class, 'store']);


Route::apiResource('channel', ChannelController::class);

Route::get('/sanctum/csrf-cookie', function (Request $request) {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('web');
});
