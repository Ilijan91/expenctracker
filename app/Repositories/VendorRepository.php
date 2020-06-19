<?php

namespace App\Repositories;

use App\Vendor;

class VendorRepository implements VendorRepositoryInterface
{
    protected $vendor;

    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    public function allVendors(){
        return $this->vendor::all();
    }

    public function findVendorById($id){
        return $this->vendor::findOrFail($id);
    }
}