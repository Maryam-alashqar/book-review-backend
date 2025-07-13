<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    return response()->json($comment, 201);
}

// عرض التعليقات
public function index($reviewId)
{
    $comments = Comment::with('user:id,name')
                ->where('review_id', $reviewId)
                ->latest()
                ->get();

    return response()->json($comments);
}

// حذف تعليق
public function destroy($id)
{
    $comment = Comment::findOrFail($id);

    if ($comment->user_id !== auth()->id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $comment->delete();

    return response()->json(['message' => 'Comment deleted']);
}

}
