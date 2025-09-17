<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Rent;

class BookService
{

    public function getAllBooks($data)
    {
        $search = $data['search'] ?? '';
        $books = Book::query()->where('books.title', 'like', '%'.$search.'%')->where('status', true)->paginate(15);
        return response()->json($books, 200);
    }
    public function nowRentedBooks(){
        $books = Rent::query()->whereNull('returned_at')->with('book')->get()->pluck('book');
        return response()->json($books, 200);
    }

    public function mostActiveBooks(){
        $books = Book::query()
            ->sortByDesc('rents_count')
            ->paginate(10);
        return response()->json($books, 200);
    }

    public function getBookById($id){
        $book = Book::query()->where('id', $id)->where('status', true)->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book, 200);
    }
}
