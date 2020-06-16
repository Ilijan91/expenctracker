<?php

namespace App;

use App\Vendor;

class Seller extends User
{
    public function vendors(){
        return $this->hasMany(Vendor::class);
    }
}
