<?php

namespace App\Policies;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CartPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->role_id === 1;
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->role_id === 1;
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return $user->role_id === 1;
    }
}
