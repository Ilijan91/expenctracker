<?php

namespace App\Repositories;

use App\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{
    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function allTransactions()
    {
        return $this->transaction::all();
    }
    public function findTransactionById($id)
    {
        return $this->transaction::findOrFail($id);
    }

    public function save($request, $vendor, $buyer, $amount, $originalAmount)
    {
        return $this->transaction::create([
            'amount' => $amount,
            'original_amount' => $originalAmount,
            'buyer_id' => $buyer->id,
            'vendor_id' => $vendor->id,
            'currency' => $request->currency,
        ]);
    }
}
