<?php


namespace Lucmas\Reservations\Policies;

use Lucmas\Reservations\Model\Role;
use Lucmas\Reservations\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isSuperAdmin())
            return true;
        return NULL;
    }

    /**
     * Determine whether the user can view any roles.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user) {
        return $user->can('view-role');
    }

    /**
     * Determine whether the user can view the role.
     *
     * @param User $user
     * @return mixed
     */
    public function view(User $user) {
        return $user->can('view-role');
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->can('create-role');
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param User $user
     * @param Role $role
     * @return mixed
     */
    public function update(User $user, Role $role) {
        if ($user->can('edit-role')) {
            if ($user->role->id === $role->id)
                return $user->isSuperAdmin();
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param User $user
     * @param Role $role
     * @return mixed
     */
    public function delete(User $user) {
        return $user->can('delete-role');
    }
}
