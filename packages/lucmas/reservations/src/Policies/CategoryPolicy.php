<?php


namespace Lucmas\Reservations\Policies;

use Lucmas\Reservations\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy {
    use HandlesAuthorization;

    public function before(User $user) {
        if ($user->isSuperAdmin())
            return true;
        return null;
    }

    /**
     * Determine whether the user can view any categories.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user) {
        return $user->can('view-category');
    }

    /**
     * Determine whether the user can view the category.
     *
     * @param User $user
     * @return mixed
     */
    public function view(User $user) {
        return $user->can('view-category');
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->can('create-category');
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param User $user
     * @return mixed
     */
    public function update(User $user) {
        return $user->can('edit-category');
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param User $user
     * @return mixed
     */
    public function delete(User $user) {
        return $user->can('delete-category');
    }

    public function products(User $user) {
        return $user->can('view-category-product');
    }
}
