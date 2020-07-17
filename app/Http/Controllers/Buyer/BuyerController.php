<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Services\BuyerService;
use App\Http\Controllers\ApiController;

class BuyerController extends ApiController
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
    public function index()
    {
        $buyers = $this->buyerService->all();

        return $this->showAll($buyers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buyer = $this->buyerService->find($id);
        $this->authorize('view', $buyer);
        return $this->showOne($buyer);
    }
}
