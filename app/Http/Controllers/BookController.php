<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->get();

        return response()->json([
                'status' => 'success',
                'data' => $books]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    if (auth()->user()->role !== 'admin') {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $request->validate([
        'title' => 'required|string',
        'author' => 'required|string',
        'category' => 'nullable|string',
        'description' => 'nullable|string',
    ]);

    $book = Book::create([
        'title' => $request->title,
        'author' => $request->author,
        'category' => $request->category,
        'description' => $request->description,
        'created_by' => auth()->id(),
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Book added successfully',
        'data' => $book], 201);
}

    /**
     * Display the specified resource.
     */
   public function search(Request $request)
{
    $query = Book::query();

    if ($request->has('title')) {
        $query->where('title', 'like', '%' . $request->title . '%');
    }

    if ($request->has('author')) {
        $query->where('author', 'like', '%' . $request->author . '%');
    }

    if ($request->has('category')) {
        $query->where('category', 'like', '%' . $request->category . '%');
    }

    $books = $query->with('reviews')->latest()->get();

    return response()->json([
        'status' => 'success',
        'message' => 'Books search results.',
        'data' => $books
    ]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
{
    if (auth()->user()->role !== 'admin' && $book->created_by !== auth()->id()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized.'
        ], 403);
    }

    $request->validate([
        'title' => 'required|string',
        'author' => 'required|string',
        'category' => 'nullable|string',
        'description' => 'nullable|string',
    ]);

    $book->update($request->only(['title', 'author', 'category', 'description']));

    return response()->json([
        'status' => 'success',
        'message' => 'Book updated successfully.',
        'data' => $book
    ]);
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
