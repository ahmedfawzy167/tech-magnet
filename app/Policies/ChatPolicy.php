<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChatPolicy
{
    /**
     * Determine whether the user can create models.
    */

    public function create(User $user): bool
    {
        return $user->role_id == 2 || $user->role_id == 1;
    }


}
