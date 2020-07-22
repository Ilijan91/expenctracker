<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Services\TransactionService;
use App\Http\Controllers\ApiController;

class BuyerTransactionController extends ApiController
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
    public function index(Buyer $buyer)
    {
        $this->authorize('view', $buyer);
        $transactions = $this->transactionService->getBuyerWithTransaction($buyer);

        return $this->showAll($transactions);
    }
}
