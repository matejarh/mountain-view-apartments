<?php

namespace App\Policies;

use App\Models\Facility;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FacilityPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->is_admin) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Facility $facility): bool
    {
        return $user->id === $facility->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Facility $facility): bool
    {
        return $user->id === $facility->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Facility $facility): bool
    {
        return $user->id === $facility->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Facility $facility): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Facility $facility): bool
    {
        //
    }
}
