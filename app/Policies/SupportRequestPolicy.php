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
        return $user->hasRole('Operations');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Student');
    }
    
}
