<?php

namespace App\Http\Controllers\Vendor;

use App\User;
use App\Vendor;
use Illuminate\Http\Request;
use App\Services\VendorService;
use Illuminate\Support\Facades\DB;
use App\Services\TransactionService;
use App\Http\Controllers\ApiController;
use App\Transformers\TransactionTransformer;

class VendorBuyerTransactionController extends ApiController
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService, VendorService $vendorService)
    {
        $this->transactionService = $transactionService;
        $this->vendorService = $vendorService;
        $this->middleware('transform.input:' . TransactionTransformer::class)->only(['store']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Vendor $vendor, User $buyer)
    {
        $rules = $this->transactionService->saveRules($request);

        $this->validate($request, $rules);

        if ($buyer->id == $vendor->seller_id) {
            return $this->errorResponse('The buyer must be different from the seller', 409);
        }

        if (!$buyer->isVerified()) {
            return $this->errorResponse('The buyer must be a verified user', 409);
        }

        if (!$vendor->seller->isVerified()) {
            return $this->errorResponse('The seller must be a verified user', 409);
        }

        if (!$vendor->isAvailable()) {
            return $this->errorResponse('The vendor is not available', 409);
        }

        if ($vendor->amount < $request->amount) {
            return $this->errorResponse('The vendor does not have enough units for this transaction', 409);
        }

        return DB::transaction(function () use ($request, $vendor, $buyer) {

            if ($request->has('currency') && $request->currency != 'RSD') {
                $exchangeRateOfCurrency = $this->transactionService->exchangeRateBetweenCurrency($request->currency, 'RSD');
                $exchangeVendorPriceCurrency = $this->transactionService->exchangeRateBetweenCurrency('RSD', $request->currency);
                $vendorPrice = $vendor->price * $exchangeVendorPriceCurrency;
                $originalAmount = $request->amount * $vendorPrice;
                $amount = $exchangeRateOfCurrency * $request->amount * $vendorPrice;
            } else {
                $amount = 1 * $request->amount * $vendor->price;
                $originalAmount = $amount;
            }
            $this->vendorService->save($vendor, $request);

            $transaction = $this->transactionService->save($request, $vendor, $buyer, $amount, $originalAmount);

            return $this->showOne($transaction, 201);
        });
    }
}
