<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Services\SellerService;
use App\Http\Controllers\ApiController;

class CategorySellerController extends ApiController
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
    public function index(Category $category)
    {
        $sellers = $this->sellerService->getCategorySellers($category);

        return $this->showAll($sellers);
    }
}
