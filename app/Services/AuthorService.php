<?php

namespace App\Services;

use App\Models\Book;

class AuthorService
{
    public function index($data){
        $user = auth()->user();
        $books = Book::query()->where('user_id', $user->id)->where('books.title', 'like', '%'. $data['search'].'%')->paginate(10);
        return response()->json($books, 200);
    }

    public function show($id){
        $user = auth()->user();
        $book = Book::query()->where('id', $id)->where('user_id', $user->id)->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book, 200);
    }

    public function store($data){
        $user = auth()->user();
        $book = Book::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'author_id' => $user->id,
            'status' => $data['status'] ?? true,
            'rents_count' => 0,
            'published_at' => $data['published_at'] ?? now(),
            'page_count' => $data['page_count'] ?? 1,
        ]);
        return response()->json($book, 201);
    }

    public function destroy($id){
        $user = auth()->user();
        $book = Book::query()->where('id', $id)->where('user_id', $user->id)->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $book->delete();
        return response()->json(['message' => 'Book deleted'], 200);
    }

    public function update($data, $id){
        $user = auth()->user();
        $book = Book::query()->where('id', $id)->where('user_id', $user->id)->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $book->update([
            'title' => $data['title'] ?? $book->title,
            'description' => $data['description'] ?? $book->description,
            'status' => $data['status'] ?? $book->status,
            'published_at' => $data['published_at'] ?? $book->published_at,
            'page_count' => $data['page_count'] ?? $book->page_count,
        ]);
        return response()->json($book, 200);
    }

    public function changeStatus($data, $id){
        $user = auth()->user();
        $book = Book::query()->where('id', $id)->where('user_id', $user->id)->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $book->status = $data['status'];
        $book->save();
        return response()->json($book, 200);
    }

    public function statistics(){
        $user = auth()->user();
        $totalBooks = Book::query()->where('user_id', $user->id)->count();
        $totalRents = Book::query()->where('user_id', $user->id)->sum('rents_count');
        $mostRentedBook = Book::query()->where('user_id', $user->id)->orderByDesc('rents_count')->first();
        return response()->json([
            'total_books' => $totalBooks,
            'total_rents' => $totalRents,
            'most_rented_book' => $mostRentedBook,
        ], 200);
    }


}
