<?php

namespace App\Policies;

use App\Models\Session;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SessionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('Instructor');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->hasRole(['Instructor','Student']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Instructor');
    }

    /**
     * Determine whether the user can update models.
     */
    public function update(User $user, Session $session)
    {
        return $user->hasRole('Instructor');
    }

    /**
     * Determine whether the user can delete models.
     */
    public function delete(User $user, Session $session)
    {
        return $user->hasRole('Instructor');
    }
}
