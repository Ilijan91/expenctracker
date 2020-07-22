<?php

namespace App\Http\Controllers\Vendor;

use App\Category;
use App\Vendor;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\ApiController;

class VendorCategoryController extends ApiController
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
    public function index(Vendor $vendor)
    {
        $categories = $this->categoryService->getVendorCategories($vendor);

        return $this->showAll($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor, Category $category)
    {
        $this->authorize('add-category', $vendor);

        $this->categoryService->updateCategoryVendor($vendor, $category);

        return $this->showAll($vendor->categories);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor, Category $category)
    {
        $this->authorize('delete-category', $vendor);

        if (!$vendor->categories()->find($category->id)) {
            return $this->errorResponse('The specified category is not a category of this vendor', 404);
        }
        $this->categoryService->deleteCategoryVendor($vendor, $category);

        return $this->showAll($vendor->categories);
    }
}
