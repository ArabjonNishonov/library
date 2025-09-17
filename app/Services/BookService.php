<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Rent;

class BookService
{
    public function getAllBooks($data)
    {
        $search = $data['search'] ?? '';
        $books = Book::with('author')
            ->where('book.title', 'LIKE', '%' . $search . '%')
            ->paginate($data['per_page'] ?? 10);
        return response()->json([
            'data' => $books,
            'message' => 'Books retrieved successfully'
        ]);
    }

    public function getBookById($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json([
            'data' => $book,
            'message' => 'Book retrieved successfully'
        ]);
    }

    public function mostRentedBooks()
    {
        $books = Book::query()
            ->orderBy('rents_count', 'desc')
            ->paginate(10);
        return response()->json([
            'data' => $books,
            'message' => 'Most rented books retrieved successfully'
        ], 200);
    }

    public function mostActiveBooks()
    {
        $books = Rent::query()->whereNull('rents.returned_at')->with('book')->paginate(10);
        return response()->json([
            'data' => $books,
            'message' => 'Most active rented books retrieved successfully'
        ], 200);
    }
}
