<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\ListRequest;
use App\Services\BookService;

class BookController extends Controller
{
    public function __construct(protected BookService $service)
    {}

    public function index(ListRequest $request){
        $data = $request->validated();
        return $this->service->getAllBooks($data);
    }

    public function show($id){
        return $this->service->getBookById($id);
    }

    public function nowRentedBooks(){
        return $this->service->mostRentedBooks();
    }

    public function mostActiveBooks(){
        return $this->service->mostActiveBooks();
    }
}
