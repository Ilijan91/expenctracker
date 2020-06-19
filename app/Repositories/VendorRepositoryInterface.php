<?php

namespace App\Repositories;

interface VendorRepositoryInterface
{
    public function allVendors();

    public function findVendorById($id);
}