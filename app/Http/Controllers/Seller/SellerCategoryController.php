<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\ApiController;

class SellerCategoryController extends ApiController
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
    public function index(Seller $seller)
    {
        $this->authorize('view', $seller);
        $categories = $this->categoryService->getSellerCategories($seller);

        return $this->showAll($categories);
    }
}
