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
            'identifier' => (int)$vendor->id,
            'title' => (string)$vendor->name,
            'details' => (string)$vendor->description,
            'quantity' => (int)$vendor->amount,
            'situation' => (string)$vendor->status,
            'seller' => (int)$vendor->seller_id,
            'creationDate' => (string)$vendor->created_at,
            'lastChange' => (string)$vendor->updated_at,
            'deletedDate' => isset($vendor->deleted_at) ? (string) $vendor->deleted_at : null,
        ];
    }
}
