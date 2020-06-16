<?php

namespace App;

use App\Vendor;
use App\Transaction;

class Buyer extends User
{
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

   
}
