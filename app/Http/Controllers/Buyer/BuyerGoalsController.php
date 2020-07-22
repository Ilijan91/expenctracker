<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Services\NotificationService;
use App\Http\Controllers\ApiController;
use App\Services\TransactionService;
use App\Services\UserService;

class BuyerGoalsController extends ApiController
{
    protected $notificationService;
    protected $transactionService;
    protected $userService;

    public function __construct(NotificationService $notificationService, TransactionService $transactionService, UserService $userService)
    {
        $this->notificationService = $notificationService;
        $this->transactionService = $transactionService;
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {

        $this->authorize('view', $buyer);

        $goals = $this->notificationService->spendingGoals($buyer);

        return response()->json(['data' => $goals, 'code' => 200], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Buyer $buyer)
    {
        $this->authorize('view', $buyer);

        $rules = $this->userService->updateRules($buyer);

        $this->validate($request, $rules);

        $this->userService->update($request, $buyer);

        return $this->showOne($buyer);
    }
}
