<?php

namespace App\Repositories;

interface SellerRepositoryInterface
{
    public function allSellers();

    public function findSellerById($id);
}