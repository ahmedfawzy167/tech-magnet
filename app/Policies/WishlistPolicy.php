<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Auth\Access\Response;

class WishlistPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('Student');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Wishlist $wishlist)
    {
        return $user->hasRole('Student');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasRole('Student');
    }

     /**
     * Determine whether the user can delete models.
     */
    public function delete(User $user, Wishlist $wishlist)
    {
        return $user->hasRole('Student');
    }
}
