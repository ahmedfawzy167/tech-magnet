<?php

namespace App\Policies;

use App\Models\SupportRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SupportRequestPolicy
{
    /**
     * Determine whether the user can view any models.
    */

    public function viewAny(User $user): bool
    {
        return $user->role_id == 3;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SupportRequest $supportRequest): bool
    {
        return $user->role_id == 3;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
       return $user->role_id = 1;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SupportRequest $supportRequest): bool
    {
        return $user->id == $supportRequest->user_id;
    }

    
}
