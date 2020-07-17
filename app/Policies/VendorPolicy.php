<?php

namespace App\Policies;

use App\User;
use App\Vendor;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function addCategory(User $user, Vendor $vendor)
    {
        return $user->id === $vendor->seller->id;
    }


    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Vendor  $vendor
     * @return mixed
     */
    public function deleteCategory(User $user, Vendor $vendor)
    {
        return $user->id === $vendor->seller->id;
    }
}
