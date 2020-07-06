<?php

namespace App\Transformers;

use App\Vendor;
use League\Fractal\TransformerAbstract;

class VendorTransformer extends TransformerAbstract
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
    public function transform(Vendor $vendor)
    {
        return [
            'identifier' => (int) $vendor->id,
            'title' => (string) $vendor->name,
            'details' => (string) $vendor->description,
            'quantity' => (int) $vendor->amount,
            'situation' => (string) $vendor->status,
            'seller' => (int) $vendor->seller_id,
            'price' => (int) $vendor->price,
            'creationDate' => (string) $vendor->created_at,
            'lastChange' => (string) $vendor->updated_at,
            'deletedDate' => isset($vendor->deleted_at) ? (string) $vendor->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('vendors.show', $vendor->id),
                ],
                [
                    'rel' => 'vendor.buyers',
                    'href' => route('vendor.buyers.index', $vendor->id),
                ],
                [
                    'rel' => 'vendor.categories',
                    'href' => route('vendor.categories.index', $vendor->id),
                ],
                [
                    'rel' => 'vendor.transactions',
                    'href' => route('vendor.transactions.index', $vendor->id),
                ],
                [
                    'rel' => 'seller',
                    'href' => route('sellers.show', $vendor->seller_id),
                ],
            ]
        ];
    }

    public static function attribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'title' => 'name',
            'details' => 'description',
            'quantity' => 'stock',
            'price' => 'price',
            'situation' => 'status',
            'seller' => 'seller_id',
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
            'name' => 'title',
            'description' => 'details',
            'price' => 'price',
            'stock' => 'quantity',
            'status' => 'situation',
            'seller_id' => 'seller',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
