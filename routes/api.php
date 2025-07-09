<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;


require base_path('routes/auth.php');


Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{book}/reviews', [ReviewController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/books', [BookController::class, 'store']);
    Route::post('/books/{book}/reviews', [ReviewController::class, 'store']);
    Route::put('/reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);

});
