<?php

namespace App\Services;

use App\Repositories\SellerRepositoryInterface;

class SellerService
{
    protected $sellerRepository;

    public function __construct(SellerRepositoryInterface $sellerRepository)
    {
        $this->sellerRepository = $sellerRepository;
    }



    public function all()
    {
        return $this->sellerRepository->allSellers();
    }

    public function find($id){
        return $this->sellerRepository->findSellerById($id);
    }
}