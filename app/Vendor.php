<?php

namespace App;

use App\Seller;
use App\Category;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use SoftDeletes;

    protected $date = ['deleted_at'];
    
    const AVAILABLE_VENDOR='available';
    const UNAVAILABLE_VENDOR='unavailable';

    protected $fillable = [
        'name',
        'description',
        'status',
        'seller_id',
        'amount',
    ];


    public function isAvailable(){
        return $this->status == Vendor::AVAILABLE_VENDOR;
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
