<?php

namespace Lucmas\Reservations\Policies;


use Lucmas\Reservations\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionGroupPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isSuperAdmin())
            return true;
        return NULL;
    }

    /**
     * Determine whether the user can view any permission groups.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user) {
        return $user->can('view-permission-group');
    }

    /**
     * Determine whether the user can view the permission group.
     *
     * @param User $user
     * @return mixed
     */
    public function view(User $user) {
        return $user->can('view-permission-group');
    }

    /**
     * Determine whether the user can create permission groups.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->can('create-permission-group');
    }

    /**
     * Determine whether the user can update the permission group.
     *
     * @param User $user
     * @return mixed
     */
    public function update(User $user) {
        return $user->can('edit-permission-group');
    }

    /**
     * Determine whether the user can delete the permission group.
     *
     * @param User $user
     * @return mixed
     */
    public function delete(User $user) {
        return $user->can('delete-permission-group');
    }
}
