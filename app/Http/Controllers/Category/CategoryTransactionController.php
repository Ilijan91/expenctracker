<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Services\TransactionService;
use App\Http\Controllers\ApiController;

class CategoryTransactionController extends ApiController
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
    public function index(Category $category)
    {
        $transactions = $this->transactionService->getCategoryTransactions($category);

        return $this->showAll($transactions);
    }
}
