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

        return response()->json(['books' => $books]);
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

    return response()->json(['book' => $book], 201);
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
