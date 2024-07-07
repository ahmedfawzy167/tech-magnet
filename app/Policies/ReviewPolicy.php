<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
{
    /**
     * Determine whether the user can create models.
     */

    public function create(User $user)
    {
        return $user->role_id == 1;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Review $review)
    {
        return $user->id == $review->user_id;
    }
}
