<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Lucmas\Reservations\Controller\Admin\AdminCategoryController;
use Lucmas\Reservations\Controller\Admin\AdminCheckoutController;
use Lucmas\Reservations\Controller\Admin\AdminProductController;
use Lucmas\Reservations\Controller\Admin\AdminTableController;
use Lucmas\Reservations\Controller\CartController;
use Lucmas\Reservations\Controller\OrderController;
use Lucmas\Reservations\Controller\ReservationController;
use Lucmas\Reservations\Model\Category;
use Lucmas\Reservations\Model\Order;
use Lucmas\Reservations\Model\OrderProduct;
use Lucmas\Reservations\Model\Product;
use Lucmas\Reservations\Model\Table;
use Lucmas\Reservations\Resources\CategoryResource;
use Lucmas\Reservations\Resources\OrderResource;
use Lucmas\Reservations\Resources\ProductResource;
use Lucmas\Reservations\Resources\TableResource;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('api')->group(function () {
    Route::get('/products', function () {
        return new ProductResource(Product::all());
    })->name('api.products');

    Route::get('/products/category/{category_id}', function ($category_id) {
        $cat = Category::find($category_id);

        if (!$cat)
            return response()->json(['code' => 500, 'message' => 'Categoria non trovata'], 500);
        return new ProductResource($cat->products()->get()->sortBy(function ($product) {
            return $product->name;
        }));
    });

    Route::get('/product/{id}', function ($id) {
        return new ProductResource(Product::find($id));
    })->name('api.product');


    Route::put('/products/edit/{product_id}', [
        'uses' => AdminProductController::class . '@update',
        'as' => 'products.update',
    ]);

    Route::post('/products/create', [
        'uses' => AdminProductController::class . '@store',
        'as' => 'products.store',
    ]);

    Route::delete('/products/delete/{product_id}', [
        'uses' => AdminProductController::class . '@delete',
        'as' => 'products.delete',
    ]);

    Route::get('/tables', function () {
        return new TableResource(Table::all());
    });

    Route::post('/tables/create', [
        'uses' => AdminTableController::class . '@store',
        'as' => 'tables.store',
    ]);

    Route::put('/tables/edit/{tables_id}', [
        'uses' => AdminTableController::class . '@update',
        'as' => 'tables.update',
    ]);

    Route::delete('/tables/delete/{tables_id}', [
        'uses' => AdminTableController::class . '@delete',
        'as' => 'tables.delete',
    ]);


    Route::get('/categories', function () {
        return new CategoryResource(Category::all());
    });

    Route::post('/categories/create', [
        'uses' => AdminCategoryController::class . '@store',
        'as' => 'categories.store',
    ]);

    Route::put('/categories/edit/{category_id}', [
        'uses' => AdminCategoryController::class . '@update',
        'as' => 'categories.update',
    ]);

    Route::delete('/categories/delete/{category_id}', [
        'uses' => AdminCategoryController::class . '@delete',
        'as' => 'categories.delete',
    ]);

    Route::get('/categories/withparent/{parent_id?}', function ($parent_id = null) {
        if (isset($parent_id))
            return new CategoryResource(Category::where('parent_id', '=', $parent_id)->orderBy('position')->get());
        else
            return new CategoryResource(Category::where('parent_id', '!=', $parent_id)->orderBy('position')->get());
    });

    Route::get('/category/{id}', function ($id) {
        return new CategoryResource(Category::find($id));
    })->name('api.categories');


    Route::post('/cart/{cart}/add', [
        'uses' => CartController::class . '@add',
        'as' => 'cart.add',
    ]);

    Route::get('/cart/{table_id}/create', [
        'uses' => CartController::class . '@create',
        'as' => 'cart.create',
    ]);

    Route::delete('/cart/{table_id}/delete/{product_id}', [
        'uses' => CartController::class . '@delete',
        'as' => 'cart.delete',
    ]);

    Route::get('/cart/{table_id}/products', [
        'uses' => CartController::class . '@products',
        'as' => 'cart.products',
    ]);

    Route::get('/cart/count', [
        'uses' => CartController::class . '@getCount',
        'as' => 'cart.count',
    ]);

    Route::get('/order/count', [
        'uses' => OrderController::class . '@getCount',
        'as' => 'order.count',
    ]);

    Route::get('/order/setDelivered/{product_id}', [
        'uses' => OrderController::class . '@setProductDelivered',
        'as' => 'order.setDelivered',
    ]);

    Route::get('/orders', function () {
        logger(json_encode(Route::current()));
        return new OrderResource(Order::with('table')->with('products')->whereHas('products', function ($query) {
            $query->where('status','=', OrderProduct::NEW);
        })->orderBy('created_at', 'desc')->get());
    });

    Route::get('/order/{order_id}', function ($order_id) {
        return new OrderResource(Order::with('table')->with('products')->where('id','=',$order_id)->first());
    });

    Route::get('/order/create/{cart_id}', [
        'uses' => OrderController::class . '@createOrderFromCart',
        'as' => 'order.create',
    ]);

    Route::get('/checkout/tables', [
        'uses' => AdminCheckoutController::class . '@getTableWithOrderList',
        'as' => 'checkout.getTable',
    ]);


});
