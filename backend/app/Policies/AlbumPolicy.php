<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Album;
use App\Models\User;

class AlbumPolicy
{
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
    public function view(User $user, Album $album): bool
    {
         return $album->owner_id === $user->id || $album->sharedWith()->whereKey($user->id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can add photo to album.
     */
    public function addPhoto(User $user, Album $album):bool {
        return $album->owner_id === $user->id
        || $album->sharedUsers()->whereKey($user->id)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Album $album): bool
    {
        return $user->id === $album->owner_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Album $album): bool
    {
        return $user->id === $album->owner_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Album $album): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Album $album): bool
    {
        return false;
    }
}
