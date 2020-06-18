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













}