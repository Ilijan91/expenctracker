<?php

namespace App;

use App\Buyer;
use App\Vendor;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\TransactionTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $date = ['deleted_at'];
    public $transformer = TransactionTransformer::class;

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
