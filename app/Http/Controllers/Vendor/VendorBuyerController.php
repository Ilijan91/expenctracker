<?php

namespace App\Http\Controllers\Vendor;

use App\Vendor;
use Illuminate\Http\Request;
use App\Services\BuyerService;
use App\Http\Controllers\ApiController;

class VendorBuyerController extends ApiController
{
    protected $buyerService;

    public function __construct(BuyerService $buyerService)
    {
        $this->buyerService = $buyerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Vendor $vendor)
    {
        $buyers = $this->buyerService->getVendorBuyers($vendor);

        return $this->showAll($buyers);
    }
}
