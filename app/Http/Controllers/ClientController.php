<?php

namespace App\Http\Controllers;


use App\Http\Requests\Rest\AddRequest;
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

    public function addRentBook(AddRequest $request, $id)
    {
        $data = $request->validated();
        return $this->clientService->addRentBook($data, $id);
    }

    public function restore($id)
    {
        return $this->clientService->restore($id);
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
