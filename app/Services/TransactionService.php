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

    public function all()
    {
        return $this->transactionRepository->allTransactions();
    }
    public function find($id)
    {
        return $this->transactionRepository->findTransactionById($id);
    }

    public function save($request, $vendor, $buyer)
    {
        return $this->transactionRepository->save($request, $vendor, $buyer);
    }

    public function getBuyerWithTransaction($buyer)
    {
        return $buyer->transactions;
    }

    public function getCategoryTransactions($category)
    {
        return $category->vendors()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();
    }

    public function getSellerTransactions($seller)
    {
        return $seller->vendors()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();
    }

    public function getVendorTransactions($vendor)
    {
        return $vendor->transactions;
    }

    public function saveRules()
    {
        $rules = [
            'amount' => 'required|integer|min:1',
            'currency' => 'required|in:EUR,USD,RSD',
        ];
        return $rules;
    }
}
