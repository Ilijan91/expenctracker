<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Services\BuyerService;
use App\Http\Controllers\ApiController;

class SellerBuyerController extends ApiController
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
    public function index(Seller $seller)
    {
        $buyers = $this->buyerService->getSellerBuyers($seller);

        return $this->showAll($buyers);
    }
}
