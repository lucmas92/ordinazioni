<?php

namespace Lucmas\Reservations\Policies;


use Lucmas\Reservations\Model\Product;
use Lucmas\Reservations\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isSuperAdmin())
            return true;
        return NULL;
    }

    /**
     * Determine whether the user can view any products.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view-product');
    }

    /**
     * Determine whether the user can view the product.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        if ($user->can('view-product')) {
            if ($product->active == 1)
                return true;
            return $user->can('view-inactive-product');
        }
        return false;
    }

    /**
     * Determine whether the user can create products.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create-product');
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        if ($user->can('edit-product')) {
            if ($product->active == 1)
                return true;
            return $user->can('view-inactive-product');
        }
        return false;
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        if ($user->can('delete-product')) {
            if ($product->active == 1)
                return true;
            return $user->can('view-inactive-product');
        }
        return false;
    }
}
