<?php

namespace App\Policies;

use App\Models\User;

class TranslationPolicy
{
    /**
     * Determine if the given post can be updated by the user.
     */
    public function update(User $user): bool
    {
        return !!$user->is_admin;
    }
}
