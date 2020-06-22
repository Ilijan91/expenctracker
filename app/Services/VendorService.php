<?php

namespace App\Services;

use App\Repositories\VendorRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

    public function getBuyerVendors($buyer){
        return $buyer->transactions()
            ->with('vendor')
            ->get()
            ->pluck('vendor');
    }

    public function getCategoryVendors($category){
        return $category->vendors;
    }

    public function getSellerVendors($seller){
        return $seller->vendors()->get();
    }

    public function storeRules(){
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required|integer|min:1'
        ];
        return $rules;
    }

    public function updateRules($vendor){
        $rules = [
            'amount' => 'integer|min:1',
            'status' => 'in:' . $vendor::AVAILABLE_VENDOR . ',' . $vendor::UNAVAILABLE_VENDOR,
        ];
        return $rules;
    }

    public function saveSellerVendor($request, $seller){
       return $this->vendorRepository->saveVendor($request, $seller);
    }

    public function checkSeller($seller, $vendor){
        if ($seller->id != $vendor->seller_id) {
            throw new HttpException(422, 'The specified seller is not the actual seller of the vendor');            
        }
    }

    public function update($request, $vendor){
        return $this->vendorRepository->updateVendor($request, $vendor);
    }

    public function delete($vendor){
        return $this->vendorRepository->deleteVendor($vendor);
    }

    public function save($vendor, $request){
        $vendor->amount -= $request->amount;
        $vendor->save();
        return ;
    }
}