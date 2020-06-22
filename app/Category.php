<?php

namespace App;

use App\User;
use App\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $date = ['deleted_at'];
    
    protected $fillable = [
        'name',
        'description'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function vendors(){
        return $this->belongsToMany(Vendor::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
