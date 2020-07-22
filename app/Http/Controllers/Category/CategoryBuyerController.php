<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Services\BuyerService;
use App\Http\Controllers\ApiController;

class CategoryBuyerController extends ApiController
{
    protected $buyerService;

    public function __construct(BuyerService $buyerService)
    {
        $this->buyerService = $buyerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $buyers = $this->buyerService->getCategoryBuyers($category);

        return $this->showAll($buyers);
    }
}
