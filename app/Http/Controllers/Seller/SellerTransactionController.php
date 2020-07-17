<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Services\TransactionService;
use App\Http\Controllers\ApiController;

class SellerTransactionController extends ApiController
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $this->authorize('view', $seller);
        $transactions = $this->transactionService->getSellerTransactions($seller);

        return $this->showAll($transactions);
    }
}
