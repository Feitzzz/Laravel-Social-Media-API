<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\CommentController;
use App\Http\Controllers\PostLikeController;
use \App\Http\Controllers\UserController;
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

// Public routes
Route::group(['prefix' => 'v1'] , function(){
    Route::apiResource('posts', PostController::class)->only(['index']);
    Route::post('users/login' , [UserController::class , 'login']);
    Route::post('users/register', [UserController::class, 'register']);
});


// Protected routes
Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function() {
    Route::apiResource('posts', PostController::class)->except(['index']);
    Route::post('posts/{post}/comments', [CommentController::class, 'store']);
    Route::post('posts/{post}/comments/{comment}', [CommentController::class, 'destroy']);
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{user}', [UserController::class, 'show']);
    Route::post('users/logout' , [UserController::class , 'logout']);
    Route::post('posts/{post}/like', [PostLikeController::class , 'like']);
    Route::post('posts/{post}/unlike', [PostLikeController::class , 'unlike']);
});
