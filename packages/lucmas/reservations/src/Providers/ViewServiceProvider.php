<?php

namespace Lucmas\Reservations\Providers;

use Illuminate\Support\Facades\View;
use \Illuminate\View\ViewServiceProvider as ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{

    public function boot() {
        View::composer(
            'Lucmas\Reservations\Views::admin.layout.nav', 'Lucmas\Reservations\View\Composers\SidebarComposer'
        );
        View::composer(
            'Lucmas\Reservations\Views::reservation.component.header', 'Lucmas\Reservations\View\Composers\ReservationHeaderComposer'
        );
    }
}
