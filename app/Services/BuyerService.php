<?php


namespace App\Services;

use App\Repositories\BuyerRepositoryInterface;

class BuyerService 
{
    protected $buyerRepository;

    public function __construct(BuyerRepositoryInterface $buyerRepository)
    {
        $this->buyerRepository = $buyerRepository;
    }


    public function all()
    {
        return $this->buyerRepository->allBuyers();
    }

    public function find($id)
    {
        return $this->buyerRepository->findBuyerById($id);
    }


    public function getCategoryBuyers($category){
        return $category->vendors()
            ->whereHas('transactions')
            ->with('transactions.buyer')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer')
            ->unique('id')
            ->values(); 
    }


    public function getSellerBuyers($seller){
        return $seller->vendors()
            ->whereHas('transactions')
            ->with('transactions.buyer')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer')
            ->unique('id')
            ->values(); 
    }

    public function getVendorBuyers($vendor){
        return $vendor->transactions()
            ->with('buyer')
            ->get()
            ->pluck('buyer')
            ->unique('id')
            ->values(); 
           
    }






}