<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Services\VendorService;
use App\Http\Controllers\ApiController;

class CategoryVendorController extends ApiController
{
    protected $vendorService;

    public function __construct(VendorService $vendorService)
    {
        $this->vendorService = $vendorService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $vendors = $this->vendorService->getCategoryVendors($category);

        return $this->showAll($vendors);
    }
}
