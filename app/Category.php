<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vendor;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function vendors(){
        return $this->belongsToMany(Vendor::class);
    }
}
