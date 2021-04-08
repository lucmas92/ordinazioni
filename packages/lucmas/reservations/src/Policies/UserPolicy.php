<?php

namespace Lucmas\Reservations\Policies;

use Lucmas\Reservations\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy {
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user) {
        if ($user->isSuperAdmin())
            return true;
        return $user->can('view-user');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @return mixed
     */
    public function view(User $user) {
        if ($user->isSuperAdmin())
            return true;
        return $user->can('view-user');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user) {
        if ($user->isSuperAdmin())
            return true;
        return $user->can('create-user');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $model
     * @return mixed
     */
    public function update(User $user, User $model) {
        if ($user->isSuperAdmin())
            return true;
        if ($user->can('edit-user')) {
            if ($model->isSuperAdmin())
                return false;

            if ($user->id == $model->id)
                return $user->isSuperAdmin();
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param User $model
     * @return mixed
     */
    public function delete(User $user, User $model) {
        if ($model->isSuperAdmin())
            return false;

        if ($user->isSuperAdmin())
            return true;
        return $user->id != $model->id && $user->can('delete-user');
    }

    /**
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function loginAsOther(User $user, User $model) {
        if ($user->id == $model->id)
            return false;
        if ($user->can('login-as-others')) {
            if ($model->isSuperAdmin())
                return $user->isSuperAdmin();
            return true;
        }
        return false;
    }
}
