<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\ApiController;

class TransactionCategoryController extends ApiController
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {
        $this->authorize('view', $transaction);

        $categories = $this->categoryService->getCategoriesWithTransactions($transaction);

        return $this->showAll($categories);
    }
}
