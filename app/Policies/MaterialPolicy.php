<?php

namespace App\Policies;

use App\Models\Material;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MaterialPolicy
{
    /**
     * Determine whether the user can view any models.
    */

    public function viewAny(User $user): bool
    {
       return $user->role_id == 2;
    }

    /**
     * Determine whether the user can view the model.
     */

    public function view(User $user, Material $material): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role_id == 2;
    }

    

}
