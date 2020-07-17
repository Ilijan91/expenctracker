<?php

namespace App\Http\Controllers\Vendor;

use App\Vendor;
use Illuminate\Http\Request;
use App\Services\TransactionService;
use App\Http\Controllers\ApiController;

class VendorTransactionController extends ApiController
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
    public function index(Vendor $vendor)
    {
        $transactions = $this->transactionService->getVendorTransactions($vendor);

        return $this->showAll($transactions);
    }
}
