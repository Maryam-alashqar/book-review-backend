<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/books', [BookController::class, 'store']);
    Route::post('/books/{book}/reviews', [ReviewController::class, 'store']);
});

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{book}/reviews', [ReviewController::class, 'index']);
