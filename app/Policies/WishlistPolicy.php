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
        return $user->role_id = 1;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Wishlist $wishlist)
    {
        return $user->id == $wishlist->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->role_id = 1;
    }
}
