<?php

namespace App;

use App\User;
use App\Vendor;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function vendors(){
        return $this->belongsToMany(Vendor::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
