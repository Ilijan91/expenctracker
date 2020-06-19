<?php

namespace App\Repositories;


interface CategoryRepositoryInterface
{
    public function allCategories();

    public function findCategoryById($id);

    public function saveCategory($request);

    public function updateCategory($request, $category);

    public function deleteCategory($category);


}