<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function getAllBooks()
    {
     $books = Book::paginate(10);
     return response()->json($books);
    }

    public function getBookById($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book);
    }
}
