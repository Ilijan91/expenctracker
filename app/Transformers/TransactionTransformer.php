<?php

namespace App\Transformers;

use App\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
            'identifier' => (int)$transaction->id,
            'quantity' => (int)$transaction->amount,
            'buyer' => (int)$transaction->buyer_id,
            'product' => (int)$transaction->vendor_id,
            'currency' => (string)$transaction->currency,
            'creationDate' => (string)$transaction->created_at,
            'lastChange' => (string)$transaction->updated_at,
            'deletedDate' => isset($transaction->deleted_at) ? (string) $transaction->deleted_at : null,
        ];
    }

    public static function attribute($index){
        $attributes = [
            'identifier' => 'id',
            'quantity' => 'amount',
            'buyer' => 'buyer_id',
            'product' => 'vendor_id',
            'currency' => 'currency',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deletedDate' =>'deleted_at',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;    
    }

}
