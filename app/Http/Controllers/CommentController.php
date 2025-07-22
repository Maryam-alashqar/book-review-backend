<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Review;

class CommentController extends Controller
{
    //
    // إضافة تعليق
public function store(Request $request, $reviewId)
{
    $request->validate(['text' => 'required|string']);

    $comment = Comment::create([
        'user_id' => auth()->id(),
        'review_id' => $reviewId,
        'text' => $request->text,
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Comment added successfully.',
        'data' => $comment, 201]);
}

// عرض التعليقات
public function index($reviewId)
{
    $comments = Comment::with('user:id,name')
                ->where('review_id', $reviewId)
                ->latest()
                ->get();

    return response()->json([
                'status' => 'success',
                'data' => $comments]);
}


public function update(Request $request, Review $review, Comment $comment)
{
    if ($comment->user_id !== auth()->id()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized.'
        ], 403);
    }

    $request->validate([
        'text' => 'required|string'
    ]);

    $comment->update([
        'text' => $request->text
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Comment updated successfully.',
        'data' => $comment
    ]);
}


// حذف تعليق
public function destroy(Comment $comment)
{
    if (auth()->id() !== $comment->user_id) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $comment->delete();

    return response()->json([
                        'status' => 'success',
                        'message' => 'Comment deleted successfully']);
}

}
