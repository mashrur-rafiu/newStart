<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);

Route::post('/login',[AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/forget-password',[AuthController::class, 'forgetpassword']);
Route::get('/reset-password/{token}', function (string $token) {
    return response()->json([
        'token' => $token
    ]);
})->name('password.reset');

Route::middleware(['auth:sanctum', 'check.token.expiration'])->group(function(){
    Route::get('/profile', function(Request $request){
        return response()->json([
            'user' => $request->user()
        ]);
    });
});
