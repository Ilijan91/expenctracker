<?php

namespace App\Services;

use App\Repositories\TransactionRepositoryInterface;

class TransactionService
{
    protected $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function all(){
        return $this->transactionRepository->allTransactions();
    }
    public function find($id){
        return $this->transactionRepository->findTransactionById($id);
    }
}