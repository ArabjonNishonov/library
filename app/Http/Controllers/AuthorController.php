<?php

namespace App\Http\Controllers;

use App\Http\Requests\Author\changeStatusBookRequest;
use App\Http\Requests\Book\AddRequest;
use App\Http\Requests\Book\ListRequest;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    public function __construct(protected AuthorService $service){}

    public function index(ListRequest $request){
        $data = $request->validated();
        return $this->service->index($data);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function store(AddRequest $request)
    {
        $data = $request->validated();
        return $this->service->store($data);
    }

    public function delete($id){
        return $this->service->destroy($id);
    }

    public function update(AddRequest $request, $id){
        $data = $request->validated();
        return $this->service->update($data, $id);
    }

    public function changeStatus(changeStatusBookRequest $request, $id)
    {
        $data = $request->validated();
        return $this->service->changeStatus($data, $id);
    }

    public function statistics()
    {
        return $this->service->statistics();
    }
}
