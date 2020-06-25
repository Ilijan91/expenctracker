<?php

namespace App;

use App\Vendor;
use App\Transformers\SellerTransformer;

class Seller extends User
{
    public $transformer = SellerTransformer::class;
    public function vendors(){
        return $this->hasMany(Vendor::class);
    }
}
