<?php

namespace App\Services;

class NotificationService
{


    protected $transactionService;
    protected $categoryService;

    public function __construct(TransactionService $transactionService, CategoryService $categoryService)
    {
        $this->transactionService = $transactionService;
        $this->categoryService = $categoryService;
    }

    public function all($buyer)
    {
        return  [
            'averagePerDay' => ['amount' => $this->averagePerDate($buyer, 'D'), 'currency' => 'RSD'],
            'averagePerWeek' => ['amount' => $this->averagePerDate($buyer, 'W'), 'currency' => 'RSD'],
            'averagePerMonth' => ['amount' => $this->averagePerDate($buyer, 'M'), 'currency' => 'RSD'],
            'averagePerYear' => ['amount' => $this->averagePerDate($buyer, 'Y'), 'currency' => 'RSD'],
            'averagePerCategory' => ['amount' => $this->averagePerCategory($buyer), 'currency' => 'RSD']
        ];
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
}
