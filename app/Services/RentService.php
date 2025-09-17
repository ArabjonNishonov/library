<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Rent;

class RentService
{
    public function getAllRents(){
        $user = auth()->user();
        $rents = Book::query()->where('author_id', $user->id)->with('rents')->paginate(15);
        return response()->json($rents, 200);
    }

    public function getRentById($id){
        $user = auth()->user();
        $rent = Rent::query()->where('id', $id)->whereHas('book', function ($query) use ($user) {
            $query->where('author_id', $user->id);
        })->first();
        if (!$rent) {
            return response()->json(['message' => 'Rent not found'], 404);
        }
        return response()->json($rent, 200);
    }

    public function expireds()
    {
        $expiredRents = Rent::query()
            ->where('due_date', '<', now())
            ->whereNull('returned_at')
            ->with('book', 'user')
            ->paginate(15);
        return response()->json($expiredRents, 200);
    }

    public function expiredBookId($id){
        $book = Book::query()->where('id', $id)->where('books.author_id', auth()->id())->whereNull('returned_at')->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }else{
            $expiredRent = Rent::query()->where('due_date', '<', now())->where('book_id', $book->id)->whereNull('returned_at')->first();
            if (!$expiredRent) {
                return response()->json(['message' => 'No expired rent found for this book'], 404);
            }
            return response()->json($expiredRent, 200);
        }
    }
}
