<?php

namespace App\Http\Controllers;


use App\Http\Requests\Rest\AddRequest;
use App\Http\Requests\Rest\ReturnRequest;
use App\Services\ClientService;

class ClientController extends Controller
{
    public function __construct(protected ClientService $clientService)
    {}

    public function rentBooks()
    {
        return $this->clientService->rentBooks();
    }

    public function rentBookId($id)
    {
        return $this->clientService->getRentById($id);
    }

    public function addRentBook(AddRequest $request)
    {
        $data = $request->validated();
        return $this->clientService->addRentBook($data);
    }

    public function restore(ReturnRequest $request)
    {
        $data = $request->validated();
        return $this->clientService->restore($data);
    }

    public function expireds()
    {
        return $this->clientService->expireds();
    }

    public function expiredBook($id)
    {
        return $this->clientService->expiredBook($id);
    }
}
