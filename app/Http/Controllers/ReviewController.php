<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Book $book)
    {
        $reviews = $book->reviews()
        ->with('user:id,name') // لعرض اسم المستخدم فقط
        ->latest()
        ->get();

        return response()->json([
            'book' => $book->title,
            'reviews' => $reviews,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review = $book->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return response()->json(['review' => $review], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
