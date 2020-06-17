<?php

namespace App;

use App\Buyer;
use App\Vendor;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'amount',
        'buyer_id',
        'vendor_id',
        'currency',
    ];

    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
}
