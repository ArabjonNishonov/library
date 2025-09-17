<?php

namespace App\Http\Controllers;

use App\Http\Requests\Author\changeStatusBookRequest;
use App\Http\Requests\Book\AddRequest;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    public function __construct(protected AuthorService $service){}

    public function index(){
        return $this->service->getAuthorBooks();
    }

    public function show($id)
    {
        return $this->service->getBookById($id);
    }

    public function store(AddRequest $request)
    {
        $data = $request->validated();
        return $this->service->addBook($data);
    }

    public function delete($id){
        return $this->service->deleteBook($id);
    }

    public function update(AddRequest $request, $id){
        $data = $request->validated();
        return $this->service->updateBook($data, $id);
    }

    public function changeStatus(changeStatusBookRequest $request, $id)
    {
        $data = $request->validated();
        return $this->service->changeStatus($data, $id);
    }
}
