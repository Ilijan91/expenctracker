<?php

namespace App\Services;

use App\Http\Controllers\ApiController;
use App\Repositories\CategoryRepositoryInterface;

class CategoryService
{
  
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all(){
        return $this->categoryRepository->allCategories();
    }

    public function find($id){
        return $this->categoryRepository->findCategoryById($id);
    }

    public function storeRules(){
        $rules = [
            'name' => 'required',
            'description' => 'required',
            
        ];
        return $rules;
    }

    public function save($request){
        return $this->categoryRepository->saveCategory($request);
    }

    public function update($request, $category){
        return $this->categoryRepository->updateCategory($request, $category);
    }

    public function delete($category){
        return $this->categoryRepository->deleteCategory($category);
    }

    public function getCategoriesWithTransactions($transaction){
        return $transaction->vendor->categories;
    }

    public function getCategoriesBuyer($buyer){
        return $buyer->transactions()
            ->with('vendor.categories')
            ->get()
            ->pluck('vendor.categories')
            ->collapse()
            ->unique('id')
            ->values();
            
    }

    public function getSellerCategories($seller){
        return $seller->vendors()
            ->whereHas('categories')
            ->with('categories')
            ->get()
            ->pluck('categories')
            ->collapse()
            ->unique('id')
            ->values();
    }

    public function getVendorCategories($vendor)
    {
        return $vendor->categories;
    }

    public function updateCategoryVendor($vendor, $category){
        return $vendor->categories()->syncWithoutDetaching([$category->id]);
    }

    public function deleteCategoryVendor($vendor, $category){
        return $vendor->categories()->detach($category->id);
    }

}