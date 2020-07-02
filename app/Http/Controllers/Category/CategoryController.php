<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\ApiController;
use App\Transformers\CategoryTransformer;

class CategoryController extends ApiController
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;

        $this->middleware('transform.input:' . CategoryTransformer::class)->only(['store', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->all();

        return $this->showAll($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->categoryService->storeRules();

        $this->validate($request, $rules);

        $category = $this->categoryService->save($request, $rules);

        return $this->showOne($category, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->categoryService->find($id);

        return $this->showOne($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = $this->categoryService->find($id);
        $this->categoryService->update($request, $category);

        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryService->find($id);

        $this->categoryService->delete($category);

        return $this->showOne($category);
    }
}
