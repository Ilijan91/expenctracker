<?php

namespace App\Repositories;

use App\Seller;
use App\Repositories\SellerRepositoryInterface;

class SellerRepository implements SellerRepositoryInterface
{
    protected $seller;

    public function __construct(Seller $seller)
    {
        $this->seller = $seller;
    }

    public function allSellers(){
        return $this->seller::has('vendors')->get();
    }

    public function findSellerById($id){
        return $this->seller::has('vendors')->findOrFail($id);
    }

}