<?php

namespace App\Services;

use App\Models\Book;
use App\Models\ExpiredBook;
use App\Models\Rent;

class ClientService
{
    public function rentBooks(){
        $rentBooks = Rent::query()->where('user_id', auth()->id())->paginate(10);
        foreach ($rentBooks as $rentBook) {
            if($rentBook->due_date < now()){
                ExpiredBook::created([
                    'book_id' => $rentBook->book_id,
                    'user_id' => $rentBook->user_id,
                    'expired_at' => now(),
                ]);
            } ;
        }
        return response()->json($rentBooks, 200);
    }

    public function getRentById($id){
        $rentBook = Rent::query()->where('id', $id)->where('user_id', auth()->id())->first();
        if (!$rentBook) {
            return response()->json(['message' => 'Rent not found'], 404);
        }
        return response()->json($rentBook, 200);
    }

    public function addRentBook($data, $id){
        $user = auth()->user();
        $book = Book::query()->where('id',$id)->where('books.status', true)->first();{
            if (!$book) {
                return response()->json(['message' => 'Book not found'], 404);
            }
        }
        $book->read_count += 1;
        $book->increment('rents_count');
        $book->save();
        $rent = Rent::query()->where('book_id', $id)->where('user_id', $user->id)->whereNull('returned_at')->first();
        if ($rent) {
            return response()->json(['message' => 'You have already rented this book'], 400);
        }else{
            $rentBook = Rent::create([
                'book_id' => $id,
                'user_id' => $user->id,
                'rent_date' => now(),
                'due_date' => $data['due_date'],
                'rented_at' => now(),
            ]);
            return response()->json($rentBook, 201);
        }
    }

    public function restore($id){
        $rentBook = Rent::query()->where('id', $id)->where('user_id', auth()->id())->whereNull('returned_at')->first();
        $expiredRent = Rent::query()
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->whereNull('returned_at')
            ->where('due_date', '<', now())
            ->first();
        if ($expiredRent) {
            $expiredRent->delete();
        }
        if (!$rentBook) {
            return response()->json(['message' => 'Rent not found or already returned'], 404);
        }
        $rentBook->update([
            'returned_at' => now(),
        ]);
        return response()->json(['message' => 'Book returned successfully'], 200);
    }

    public function expireds(){
        $expiredRents = Rent::query()
            ->where('user_id', auth()->id())
            ->whereNull('returned_at')
            ->where('due_date', '<', now())
            ->paginate(10);
        return response()->json($expiredRents, 200);
    }

    public function expiredBook($id){
        $expiredRent = Rent::query()
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->whereNull('returned_at')
            ->where('due_date', '<', now())
            ->first();
        if (!$expiredRent) {
            return response()->json(['message' => 'No expired rent found with this ID'], 404);
        }
        return response()->json($expiredRent, 200);
    }
}
