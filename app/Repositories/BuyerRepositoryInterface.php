<?php

namespace App\Repositories;


interface BuyerRepositoryInterface
{
    public function allBuyers();

    public function findBuyerById($id);
}