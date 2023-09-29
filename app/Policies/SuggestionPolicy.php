<?php

namespace App\Policies;

use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SuggestionPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasPermissionTo('manage suggestions')) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Suggestion $suggestion): bool
    {
        return true; //We always want everyone to be able to view the suggestion
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; //Protected by auth middleware anyway
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Suggestion $suggestion): bool
    {
        return $user->id === $suggestion->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Suggestion $suggestion): bool
    {
        return $user->id === $suggestion->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Suggestion $suggestion): bool
    {
        return $user->hasPermissionTo('manage suggestions');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Suggestion $suggestion): bool
    {
        return $user->hasPermissionTo('manage suggestions');
    }

    public function manage(User $user, Suggestion $suggestion): bool
    {
        return $user->hasPermissionTo('manage suggestions');
    }
}
