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
        return $user->role_id == 2 || $user->role_id == 1;
    }

    /**
     * Determine whether the user can create models.
    */
    public function create(User $user): bool
    {
        return $user->role_id == 2;
    }


}
