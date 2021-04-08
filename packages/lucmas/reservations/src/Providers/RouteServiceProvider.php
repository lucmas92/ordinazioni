<?php
/**
 * Copyright (c) 2020/2
 * Created by Federico Papetti
 */


namespace Lucmas\Reservations\Providers;

use Illuminate\Support\Facades\Route;
use Lucmas\Reservations\Model\Cart;

class RouteServiceProvider extends \App\Providers\RouteServiceProvider
{

    public function register()
    {
        parent::register();
    }

    public function boot()
    {
        parent::boot();
        Route::model('cart', 'Cart');

    }

}
