<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class AuthorService
{
    public function index($data)
    {
        $user = auth()->user();
        $authorBooks = Book::where('author_id', $user->id)->paginate($data['per_page'] ?? 15);
        return response()->json($authorBooks);
    }

    public function show($id)
    {
        $user = auth()->user();
        $book = Book::where('author_id', $user->id)->where('id', $id)->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book);
    }

    public function store($data)
    {
        if (isset($data['pdf'])){
            $path= time().$data['pdf'];
            $data['pdf']->storeAs('public/pdfs',$path);
        }
        $user = auth()->user();
        $book = Book::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'author_id' => $user->id,
            'status' => 'available',
            'pdf' => $path ?? null,
            'published_year' => $data['date']??now()->year,
        ]);
        return response()->json($book, 201);
    }

    public function update($data, $id)
    {
        $book = Book::where('author_id', $user->id)->where('id', $id)->first();

        if($book->pdf){
            unlink(storage_path('app/public/pdfs/'.$book->pdf));
            Storage::delete('public/pdfs/'.$book->pdf);
        }
        if (isset($data['pdf'])){
            $path= time().$data['pdf'];
            $data['pdf']->storeAs('public/pdfs',$path);
            $data['pdf'] = $path;
        }
        $user = auth()->user();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $book->update([
            'title' => $data['title'] ?? $book->title,
            'description' => $data['description'] ?? $book->description,
            'pdf' => $data['pdf'] ?? $book->pdf,
        ]);
        return response()->json($book);
    }

    public function changeStatus($data, $id)
    {
        $user = auth()->user();
        $book = Book::where('author_id', $user->id)->where('id', $id)->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        if ($data['available'] && $book->status === true) {
            return response()->json(['message' => 'Cannot mark as available. Book is currently available.'], 400);
        }
        if ($data['unavailable'] && $book->status === false) {
            return response()->json(['message' => 'Cannot mark as unavailable. Book is currently unavailable.'], 400);
        }
        if ($data['available'] && $book->status === false) {
            $book->is_active = true;
            $book->save();
            return response()->json($book);

        } elseif ($data['unavailable'] && $book->status === true) {
            $book->status = false;
            $book->save();
            return response()->json($book);
        }
    }

    public function destroy($id){
        $user = auth()->user();
        $book = Book::where('author_id', $user->id)->where('id', $id)->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        if($book->pdf){
            unlink(storage_path('app/public/pdfs/'.$book->pdf));
            Storage::delete('public/pdfs/'.$book->pdf);
        }
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully']);
    }
}
