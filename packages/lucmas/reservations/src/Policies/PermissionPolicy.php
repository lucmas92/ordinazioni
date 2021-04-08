<?php

namespace Lucmas\Reservations\Policies;


use Lucmas\Reservations\Model\Permission;
use Lucmas\Reservations\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isSuperAdmin())
            return true;
        return NULL;
    }

    /**
     * Determine whether the user can view any permissions.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user) {
        return $user->can('view-permission');
    }

    /**
     * Determine whether the user can view the permission.
     *
     * @param User $user
     * @return mixed
     */
    public function view(User $user) {
        return $user->can('view-permission');
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->can('create-permission');
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param User $user
     * @return mixed
     */
    public function update(User $user) {
        return $user->can('edit-permission');
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param User $user
     * @return mixed
     */
    public function delete(User $user) {
        return $user->can('delete-permission');
    }
}
