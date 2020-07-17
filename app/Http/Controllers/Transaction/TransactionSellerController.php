<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Services\SellerService;
use App\Http\Controllers\ApiController;

class TransactionSellerController extends ApiController
{
    protected $sellerService;

    public function __construct(SellerService $sellerService)
    {
        $this->sellerService = $sellerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {
        $seller = $this->sellerService->getSellerWithTransactions($transaction);
        $this->authorize('view', $transaction);
        return $this->showOne($seller);
    }
}
