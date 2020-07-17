<?php

namespace App\Http\Controllers\Vendor;


use App\Services\VendorService;
use App\Http\Controllers\ApiController;

class VendorController extends ApiController
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
    public function index()
    {
        $vendors = $this->vendorService->all();

        return $this->showAll($vendors);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendor = $this->vendorService->find($id);

        return $this->showOne($vendor);
    }
}
