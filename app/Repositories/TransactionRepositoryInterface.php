<?php

namespace App\Repositories;

interface TransactionRepositoryInterface
{
    public function allTransactions();

    public function findTransactionById($id);

    public function save($request, $vendor, $buyer);
}