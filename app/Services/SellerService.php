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

    public function getSellerWithTransactions($transaction){
        return $transaction->vendor->seller;
    }

    public function getSellersWithBuyer($buyer){
        return $buyer->transactions()
            ->with('vendor.seller')
            ->get()
            ->pluck('vendor.seller')
            ->unique('id')
            ->values();
    }

    public function getCategorySellers($category){
        return $category->vendors()
            ->with('seller')
            ->get()
            ->pluck('seller')
            ->unique('id')
            ->values();

    }
}