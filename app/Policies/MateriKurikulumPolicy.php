<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\MateriKurikulum;
use App\Models\User;

class MateriKurikulumPolicy
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
    public function view(User $user, MateriKurikulum $materiKurikulum): bool
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
    public function update(User $user, MateriKurikulum $materiKurikulum): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MateriKurikulum $materiKurikulum): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MateriKurikulum $materiKurikulum): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MateriKurikulum $materiKurikulum): bool
    {
        //
    }
}
