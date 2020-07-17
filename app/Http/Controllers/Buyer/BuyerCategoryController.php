<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\ApiController;
use App\Policies\BuyerPolicy;

class BuyerCategoryController extends ApiController
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
    public function index(Buyer $buyer)
    {
        $this->authorize('view', $buyer);
        $categories = $this->categoryService->getCategoriesBuyer($buyer);

        return $this->showAll($categories);
    }
}
