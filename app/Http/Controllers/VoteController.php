<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Vote;

class VoteController extends Controller
{
    
    public function vote(Request $request, $id)
{
    $request->validate([
        'vote_type' => 'required|in:up,down',
    ]);

    $review = Review::findOrFail($id);

    $vote = Vote::updateOrCreate(
        [
            'user_id' => auth()->id(),
            'review_id' => $review->id
        ],
        [
            'vote_type' => $request->vote_type
        ]
    );

    return response()->json(['message' => 'Vote recorded', 'vote' => $vote], 200);
}

}
