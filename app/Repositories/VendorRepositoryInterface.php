<?php

namespace App\Repositories;

interface VendorRepositoryInterface
{
    public function allVendors();

    public function findVendorById($id);

    public function saveVendor($request, $seller);

    public function updateVendor($request, $vendor);

    public function deleteVendor($vendor);
}