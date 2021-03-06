<?php

namespace App\Transformers;

use App\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
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
    public function transform(Buyer $buyer)
    {
        return [
            'identifier' => (int) $buyer->id,
            'name' => (string) $buyer->name,
            'notification' => (string) $buyer->notification,
            'spending_goal' => (string) $buyer->spending_goal,
            'phone' => (int) $buyer->phone,
            'email' => (string) $buyer->email,
            'isVerified' => (int) $buyer->verified,
            'creationDate' => (string) $buyer->created_at,
            'lastChange' => (string) $buyer->updated_at,
            'deletedDate' => isset($buyer->deleted_at) ? (string) $buyer->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('buyers.show', $buyer->id),
                ],
                [
                    'rel' => 'buyer.categories',
                    'href' => route('buyer.categories.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.stats',
                    'href' => route('buyer.stats.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.goals',
                    'href' => route('buyer.goals.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.vendors',
                    'href' => route('buyer.vendors.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.sellers',
                    'href' => route('buyer.sellers.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.transactions',
                    'href' => route('buyer.transactions.index', $buyer->id),
                ],
                [
                    'rel' => 'user',
                    'href' => route('users.show', $buyer->id),
                ],
            ],


        ];
    }
    public static function attribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'name' => 'name',
            'notification' => 'notification',
            'spending_goal' => 'spending_goal',
            'phone' => 'phone',
            'email' => 'email',
            'isVerified' => 'verified',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deletedDate' => 'deleted_at',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identifier',
            'name' => 'name',
            'notification' => 'notification',
            'spending_goal' => 'spending_goal',
            'phone' => 'phone',
            'email' => 'email',
            'verified' => 'isVerified',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
