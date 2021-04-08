<?php

namespace Lucmas\Reservations\Traits;

use Illuminate\Contracts\Auth\Access\Gate;

trait CanAnyTrait {
    public function canAny(array $abilities, $arguments = []) {
        return collect($abilities)->reduce(function($canAccess, $ability) use ($arguments) {
            // if this user has access to any of the previously checked abilities, or the current ability, return true
            return $this->role->slug == 'superadmin' || $canAccess || app(Gate::class)->forUser($this)->check($ability, $arguments);
        }, false);
    }
}
