<?php

namespace App\Services;

use App\Buyer;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Repositories\TransactionRepositoryInterface;

class TransactionService
{
    const CACHE_KEY = 'TRANSACTIONS';
    protected $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function all()
    {
        return $this->transactionRepository->allTransactions();
    }
    public function find($id)
    {
        return $this->transactionRepository->findTransactionById($id);
    }

    public function save($request, $vendor, $buyer, $amount, $originalAmount)
    {
        return $this->transactionRepository->save($request, $vendor, $buyer, $amount, $originalAmount);
    }

    public function getBuyerCategoryWithTransaction($category, $buyer)
    {
        return $category->vendors()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->where('buyer_id', $buyer->id)
            ->values();
    }
    public function getBuyerWithTransaction($buyer)
    {
        return $buyer->transactions;
    }

    public function getBuyerWithTransactionTotalAmount(Buyer $buyer)
    {
        return $buyer->transactions->pluck('amount');
    }

    public function getCategoryTransactions($category)
    {
        return $category->vendors()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();
    }



    public function getSellerTransactions($seller)
    {
        return $seller->vendors()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();
    }

    public function getVendorTransactions($vendor)
    {
        return $vendor->transactions;
    }

    public function getCacheKey($key)
    {
        $key = strtoupper($key);
        return self::CACHE_KEY . ".$key";
    }

    public function saveRules($request)
    {
        $collection = $this->getCurrencyList();

        $rules = [
            'amount' => 'required|integer|min:1',
            'currency' => 'required|in:'  . $collection[$request->currency]['id'],
        ];
        return $rules;
    }


    public function exchangeRateBetweenCurrency($from, $to)
    {
        $key = "exchange.rate.between.currency." . $from . "." . $to;
        $cacheKey = $this->getCacheKey($key);
        $apiKey = config('services.currency.apiKey');

        return Cache::remember($cacheKey, Carbon::now()->addHours(24), function () use ($from, $to, $apiKey) {
            return Http::get('https://free.currconv.com/api/v7/convert?q=' . $from . '_' . $to . '&compact=ultra&apiKey=' . $apiKey)
                ->json()[$from . '_' . $to];
        });
    }

    private function getCurrencyList()
    {
        $apiKey = config('services.currency.apiKey');

        return Http::get('https://free.currconv.com/api/v7/currencies?apiKey=' . $apiKey)
            ->json()['results'];
    }
}
