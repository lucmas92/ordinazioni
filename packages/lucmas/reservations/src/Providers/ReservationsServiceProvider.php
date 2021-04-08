<?php
/**
 * Copyright (c) 2020/2
 * Created by Federico Papetti
 */


namespace Lucmas\Reservations\Providers;

use App\Http\Kernel;
use Carbon\Carbon;
use Lucmas\Reservations\Controller\Admin\AdminCategoryController;
use Lucmas\Reservations\Controller\Admin\AdminCheckoutController;
use Lucmas\Reservations\Controller\Admin\AdminController;
use Lucmas\Reservations\Controller\Admin\AdminOrderController;
use Lucmas\Reservations\Controller\Admin\AdminProductController;
use Lucmas\Reservations\Controller\Admin\AdminTableController;
use Lucmas\Reservations\Controller\Auth\LoginController;
use Lucmas\Reservations\Controller\ProductController;
use Lucmas\Reservations\Controller\ReservationController;
use Lucmas\Reservations\Model\Cart;
use Lucmas\Reservations\Model\Category;
use Lucmas\Reservations\Model\CategoryProduct;
use Lucmas\Reservations\Model\CategoryTranslation;
use Lucmas\Reservations\Model\File;
use Lucmas\Reservations\Model\ImageCategory;
use Lucmas\Reservations\Model\ImageCategoryTranslation;
use Lucmas\Reservations\Model\ImageProduct;
use Lucmas\Reservations\Model\ImageProductTranslation;
use Lucmas\Reservations\Model\Permission;
use Lucmas\Reservations\Model\PermissionGroup;
use Lucmas\Reservations\Model\PermissionGroupTranslation;
use Lucmas\Reservations\Model\PermissionTranslation;
use Lucmas\Reservations\Model\Product;
use Lucmas\Reservations\Model\ProductTranslation;
use Lucmas\Reservations\Model\Related;
use Lucmas\Reservations\Model\Reservation;
use Lucmas\Reservations\Model\Role;
use Lucmas\Reservations\Model\RoleTranslation;
use Lucmas\Reservations\Model\SidebarItem;
use Lucmas\Reservations\Model\User;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class ReservationsServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->registerModel();
        $this->registerController();
    }

    public function registerController()
    {
        $this->app->bind('AdminController', function ($app, $params) {
            return new AdminController();
        });
        $this->app->bind('AdminCategoryController', function ($app, $params) {
            return new AdminCategoryController();
        });
        $this->app->bind('AdminCheckoutController', function ($app, $params) {
            return new AdminCheckoutController();
        });
        $this->app->bind('AdminOrderController', function ($app, $params) {
            return new AdminOrderController();
        });
        $this->app->bind('AdminProductController', function ($app, $params) {
            return new AdminProductController();
        });
        $this->app->bind('AdminTableController', function ($app, $params) {
            return new AdminTableController();
        });
        $this->app->bind('LoginController', function ($app, $params) {
            return new LoginController();
        });
        $this->app->bind('ReservationController', function ($app, $params) {
            return new ReservationController();
        });
    }

    public function registerModel()
    {
        $this->app->bind('Category', function ($app, $params) {
            return new Category();
        });
        $this->app->bind('Cart', function ($app, $params) {
            return new Cart();
        });
        $this->app->bind('CategoryProduct', function ($app, $params) {
            return new CategoryProduct();
        });
        $this->app->bind('CategoryTranslation', function ($app, $params) {
            return new CategoryTranslation();
        });
        $this->app->bind('File', function ($app, $params) {
            return new File();
        });
        $this->app->bind('ImageCategory', function ($app, $params) {
            return new ImageCategory();
        });
        $this->app->bind('ImageCategoryTranslation', function ($app, $params) {
            return new ImageCategoryTranslation();
        });
        $this->app->bind('ImageProduct', function ($app, $params) {
            return new ImageProduct();
        });
        $this->app->bind('ImageProductTranslation', function ($app, $params) {
            return new ImageProductTranslation();
        });
        $this->app->bind('Permission', function ($app, $params) {
            return new Permission();
        });
        $this->app->bind('PermissionTranslation', function ($app, $params) {
            return new PermissionTranslation();
        });
        $this->app->bind('PermissionGroup', function ($app, $params) {
            return new PermissionGroup();
        });
        $this->app->bind('PermissionGroupTranslation', function ($app, $params) {
            return new PermissionGroupTranslation();
        });
        $this->app->bind('Product', function ($app, $params) {
            return new Product();
        });
        $this->app->bind('ProductTranslation', function ($app, $params) {
            return new ProductTranslation();
        });
        $this->app->bind('Related', function ($app, $params) {
            return new Related();
        });
        $this->app->bind('Reservation', function ($app, $params) {
            return new Reservation();
        });
        $this->app->bind('Role', function ($app, $params) {
            return new Role();
        });
        $this->app->bind('RoleTranslation', function ($app, $params) {
            return new RoleTranslation();
        });
        $this->app->bind('SidebarItem', function ($app, $params) {
            return new SidebarItem();
        });
        $this->app->bind('User', function ($app, $params) {
            return new User();
        });

    }

    public function boot(Router $router, Kernel $kernel)
    {

        $this->cleanCart();

        // pubblicazione di file e cartelle necessarie
        $this->publish();

        // carico le migrazione del database
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // carico le rotte per il progetto PIM
        $this->loadRoutesFrom(__DIR__ . '/../../routes/routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');

        // carico le viste
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/', 'Lucmas\Reservations\Views');

        // carico le traduzioni
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang/', 'Reservations');

        // carico le configurazioni
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php', 'config'
        );

        // carico le configurazioni
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/translatable.php', 'translatable'
        );

        // Imposto la lingua di default
        Config::set('app.locale', env('APP_LOCALE', 'it'));
        Config::set('app.fallback_locale', env('APP_LOCALE', 'it'));

        $config = ['private' =>
            [
                'driver' => 'local',
                'root' => storage_path('private'),
                'url' => env('APP_URL') . '/storage',
                'visibility' => 'private',
            ]
        ];

        Config::set('filesystems.disks', $config);
    }

    public function publish()
    {
        // pubblicazione cartella storage/private
        $this->publishes([
            __DIR__ . '/../../storage/private' => storage_path('private/'),
        ], 'Lucmas\Reservations_storage');

        // permetto la pubblicazione degli assets per personalizzazione
        $this->publishes([
            __DIR__ . '/../../resources/assets' => public_path('assets'),
        ], 'Lucmas\Reservations_assets');

        // pubblicazione immagini
        $this->publishes([
            __DIR__ . '/../../resources/images' => public_path('images/'),
        ], 'Lucmas\Reservations_images');

        // pubblicazione fontawesome
        $this->publishes([
            __DIR__ . '/../../resources/fontawesome' => public_path('assets/fontawesome/'),
        ], 'Lucmas\Reservations_fontawesome');
    }


    protected function cleanCart(){
        /** @var Cart $cart */
        $cart = app()->make('Cart');
        $date  = Carbon::now()->subMinutes( 60 );

        // elimino carrelli vecchi
        $cart->where('updated_at', '<=', $date)->delete();
    }

}
