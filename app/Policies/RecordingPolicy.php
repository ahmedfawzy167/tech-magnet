<?php

namespace App\Policies;

use App\Models\Recording;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RecordingPolicy
{
    
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Recording $recording): bool
    {
        return $user->role_id == 1;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role_id == 3;
    }


}
