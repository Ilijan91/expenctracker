<?php

namespace App\Services;

use App\Repositories\VendorRepositoryInterface;

class VendorService
{
    protected $vendorRepository;

    public function __construct(VendorRepositoryInterface $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
    }


    public function all(){
        return $this->vendorRepository->allVendors();
    }

    public function find($id)
    {
        return $this->vendorRepository->findVendorById($id);
    }
}