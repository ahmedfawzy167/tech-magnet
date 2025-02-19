<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class QuestionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
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


}
