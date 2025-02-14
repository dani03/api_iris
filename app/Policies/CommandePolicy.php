<?php

namespace App\Policies;

use App\Enums\Status;
use App\Models\Commande;
use App\Models\User;

class CommandePolicy
{
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
    public function view(User $user, Commande $commande): bool
    {
        //
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
    public function update(?User $user, Commande $commande): bool
    {
        return $commande->status !== Status::COMPLETED->value;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Commande $commande): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Commande $commande): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Commande $commande): bool
    {
        //
    }
}
