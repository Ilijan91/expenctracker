<?php

namespace App\Services;

use App\Buyer;


class NotificationService
{


    protected $transactionService;
    protected $categoryService;
    protected $vendorService;

    public function __construct(TransactionService $transactionService, CategoryService $categoryService, VendorService $vendorService)
    {
        $this->transactionService = $transactionService;
        $this->categoryService = $categoryService;
        $this->vendorService = $vendorService;
    }

    public function all($buyer)
    {
        return  [
            'currency' => 'RSD',
            'averagePerDay' => $this->averagePerDate($buyer, 'D'),
            'averagePerWeek' => $this->averagePerDate($buyer, 'W'),
            'averagePerMonth' => $this->averagePerDate($buyer, 'M'),
            'averagePerYear' => $this->averagePerDate($buyer, 'Y'),
            'averagePerCategory' => $this->averagePerCategory($buyer),
            'topVendors' => $this->topVendors($buyer),
        ];
    }

    public function spendingGoals($buyer)
    {
        return [
            'goal_per_day' => $buyer->spending_goal,
            'amount_spent' => $this->totalExpence($buyer),
            'amount_left' => $this->amountLeft($buyer),
            'currency' => 'RSD'
        ];
    }

    public function totalExpence($buyer)
    {
        $transactionsAmount = $this->transactionService->getBuyerWithTransactionTotalAmount($buyer);

        $totalExspence = 0;
        foreach ($transactionsAmount as $amount) {
            $totalExspence += $amount;
        }
        return $totalExspence;
    }

    public function amountLeft(Buyer $buyer)
    {
        return $buyer->spending_goal - $this->totalExpence($buyer);
    }

    private function averagePerDate($buyer, $dateFormat)
    {
        $transactions = $this->transactionService->getBuyerWithTransaction($buyer);

        $new_result_array = [];
        $average_prices = [];

        foreach ($transactions as $row) {

            if (!isset($new_result_array[date($dateFormat, strtotime($row['created_at']))])) {
                $new_result_array[date($dateFormat, strtotime($row['created_at']))] = [];
                $new_result_array[date($dateFormat, strtotime($row['created_at']))]['order_total'] = 0;
                $new_result_array[date($dateFormat, strtotime($row['created_at']))]['orders'] = [];
            }

            $new_result_array[date($dateFormat, strtotime($row['created_at']))]['order_total'] += $row['amount'];
            $new_result_array[date($dateFormat, strtotime($row['created_at']))]['orders'][] = $row;
        }

        foreach ($new_result_array as $period => $orders) {
            $average_prices[$period] = $orders['order_total'] / count($orders['orders']);
        }

        return $average_prices;
    }

    private function averagePerCategory($buyer)
    {
        $categories = $this->categoryService->getCategoriesBuyer($buyer);
        $average_prices = [];

        foreach ($categories as $category) {
            $transactions = $this->transactionService->getBuyerCategoryWithTransaction($category, $buyer);

            $total = [];
            $new_result_array = [];
            foreach ($transactions as $transaction) {

                $new_result_array['order_total'] = 0;
                $new_result_array['orders'] = [];

                $new_result_array['order_total'] += $transaction['amount'];

                $new_result_array['orders'][] = $transaction;
                $total[] = $new_result_array['order_total'];
            }
            $average_prices[$category->name] = array_sum($total)  / count($total);
        }
        return $average_prices;
    }

    private function topVendors($buyer)
    {
        $vendors = $this->vendorService->getBuyerVendors($buyer);

        $uniques = array();
        foreach ($vendors as $obj) {
            $uniques[$obj->name] = $obj->created_at;
        }

        return $uniques;
    }
}
