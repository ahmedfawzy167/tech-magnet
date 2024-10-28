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
        return $user->role_id = 1;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cart $cart)
    {
        return $user->id == $cart->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->role_id = 1;
    }
}
