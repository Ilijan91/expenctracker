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

    public function saveVendor($request, $seller){
        $data = $request->all();
        $data['status'] = $this->vendor::UNAVAILABLE_VENDOR;
        $data['seller_id'] = $seller->id;

        return $this->vendor::create($data);
    }

    public function updateVendor($request, $vendor){
        $vendor->fill($request->only([
            'name',
            'description',
            'amount',
        ]));

        return $vendor->save();
    }

    public function deleteVendor($vendor){
        return $vendor->delete();
    }

    
}