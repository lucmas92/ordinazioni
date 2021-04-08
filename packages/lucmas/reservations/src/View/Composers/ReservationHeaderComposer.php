<?php

namespace Lucmas\Reservations\View\Composers;

use Lucmas\Reservations\Model\Category;
use Illuminate\View\View;

class ReservationHeaderComposer {
    public function compose(View $view) {

        $category = app()->make('Category');
        $cat = $category::with('translation');

        $main_categories = $cat->whereTranslationLike('name', 'Piatti', config('translatable.locale'))
            ->orWhereTranslationLike('name', 'Bevande', config('translatable.locale'))
            ->get();

        $view->with('main_categories', $main_categories);
    }
}
