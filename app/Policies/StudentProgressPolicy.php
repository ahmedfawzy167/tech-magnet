<?php

namespace App\Policies;

use App\Models\StudentProgress;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StudentProgressPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
       return $user->role_id == 5;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, StudentProgress $studentProgress): bool
    {
        return $user->role_id == 5 || $user->role_id == 1;
    }

    /**
     * Determine whether the user can create models.
     */

    public function create(User $user): bool
    {
        return $user->role_id == 5;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, StudentProgress $studentProgress): bool
    {
        return $user->role_id == 5;
    }

   
    
}
