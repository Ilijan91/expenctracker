<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function allCategories(){
        return $this->category::all();
    }

    public function findCategoryById($id){
        return $this->category::findOrFail($id);
    }

    public function saveCategory($request){
        return $this->category::create($request->all());
    }

    public function updateCategory($request, $category){
        $category->fill($request->only([
            'name',
            'description'
        ]));
        
        return $category->save();
    }

    public function deleteCategory($category){
        return $category->delete();
    }
}