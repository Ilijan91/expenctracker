<?php

namespace App\Repositories;

use App\Buyer;
use App\Repositories\BuyerRepositoryInterface;


class BuyerRepository implements BuyerRepositoryInterface
{
    protected $buyer;
   
    public function __construct(Buyer $buyer)
    {
        $this->buyer = $buyer;
    }

    public function allBuyers(){
        return $this->buyer::has('transactions')->get();
    }

    public function findBuyerById($id){
        return $this->buyer::has('transactions')->findOrFail($id);
    }

}