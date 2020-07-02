<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use App\Vendor;
use Illuminate\Http\Request;
use App\Services\VendorService;
use App\Http\Controllers\ApiController;
use App\Transformers\VendorTransformer;

class SellerVendorController extends ApiController
{
    protected $vendorService;

    public function __construct(VendorService $vendorService)
    {
        $this->vendorService = $vendorService;

        $this->middleware('transform.input:' . VendorTransformer::class)->only(['store', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $vendors = $this->vendorService->getSellerVendors($seller);

        return $this->showAll($vendors);
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
    public function store(Request $request, Seller $seller)
    {
        $rules = $this->vendorService->storeRules();

        $this->validate($request, $rules);

        $vendor = $this->vendorService->saveSellerVendor($request, $seller);

        return $this->showOne($vendor);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller, Vendor $vendor)
    {
        $rules = $this->vendorService->updateRules($vendor);

        $this->validate($request, $rules);

        $this->vendorService->checkSeller($seller, $vendor);

        if ($request->has('status')) {
            $vendor->status = $request->status;

            if ($vendor->isAvailable() && $vendor->categories()->count() == 0) {
                return $this->errorResponse('An active vendor must have at least one category', 409);
            }
        }

        $this->vendorService->update($request, $vendor);

        return $this->showOne($vendor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller, Vendor $vendor)
    {
        $this->vendorService->checkSeller($seller, $vendor);

        $this->vendorService->delete($vendor);

        return $this->showOne($vendor);
    }
}
