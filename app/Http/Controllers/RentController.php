<?php

namespace App\Http\Controllers;


use App\Services\RentService;

class RentController extends Controller
{
    public function __construct(protected RentService $service)
    {}

    public function index(){
        return $this->service->getAllRents();
    }

    public function rentBook($bookId){
        return $this->service->rentBook($bookId);
    }

    public function expireds(){
        return $this->service->expireds();
    }

    public function expiredBook($bookId){
        return $this->service->returnBook($bookId);
    }
}
