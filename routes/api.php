<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\CommentController;


require base_path('routes/auth.php');


Route::get('/books', [BookController::class, 'index']);
Route::get('/books/search', [BookController::class, 'search']);

Route::get('/books/{book}/reviews', [ReviewController::class, 'index']);
Route::get('/reviews/{reviewId}/comments', [CommentController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{book}', [BookController::class, 'update']);
    Route::post('/books/{book}/reviews', [ReviewController::class, 'store']);

    //
    Route::put('/reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
    Route::post('/reviews/{id}/vote', [VoteController::class, 'vote']);
    Route::post('/reviews/{reviewId}/comments', [CommentController::class, 'store']);

    //
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
    Route::put('/reviews/{review}/comments/{comment}', [CommentController::class, 'update']);
});
