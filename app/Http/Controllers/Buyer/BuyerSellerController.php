<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Services\SellerService;
use App\Http\Controllers\ApiController;

class BuyerSellerController extends ApiController
{
    protected $sellerService;

    public function __construct(SellerService $sellerService)
    {
        $this->sellerService = $sellerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $sellers = $this->sellerService->getSellersWithBuyer($buyer);

        return $this->showAll($sellers);
    }
}
