<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Services\NotificationService;

class BuyerStatsController extends ApiController
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $this->authorize('view', $buyer);
        $stats = $this->notificationService->all($buyer);

        return response()->json(['data' => $stats, 'code' => 200], 200);
    }
}
