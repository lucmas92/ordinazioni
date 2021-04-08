<?php

namespace Lucmas\Reservations\View\Composers;

use Lucmas\Reservations\Model\SidebarItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SidebarComposer {
    public function compose(View $view) {
        $elements = SidebarItem::all()->each(function ($item) {
            $item->level = $item->level();

            if ($item->level == 0) {
                $item->permissions = $item->allPermissions();
                $item->can = ($item->permission != NULL && Auth::user()->can($item->permission))
                    || ($item->permission == NULL && count($item->permissions) == 0)
                    || (count($item->permissions) !== 0 && Auth::user()->canAny($item->permissions))
                    || (count($item->permissions) < count($item->children));
            }
        });

        $level0 = $elements->where('level', '=', 0)
            ->sortBy(function ($element) {return $element->position;});

        $view->with('elements', $elements);
        $view->with('level0', $level0);
    }
}
