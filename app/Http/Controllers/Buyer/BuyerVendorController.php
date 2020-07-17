<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Services\VendorService;
use App\Http\Controllers\ApiController;

class BuyerVendorController extends ApiController
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
    public function index(Buyer $buyer)
    {
        $this->authorize('view', $buyer);
        $vendors = $this->vendorService->getBuyerVendors($buyer);

        return $this->showAll($vendors);
    }
}
