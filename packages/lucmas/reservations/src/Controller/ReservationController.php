<?php

namespace Lucmas\Reservations\Controller;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Lucmas\Reservations\Model\Cart;
use Lucmas\Reservations\Model\Category;
use Lucmas\Reservations\Model\Product;
use Lucmas\Reservations\Model\Table;

class ReservationController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    protected function getCart(Table $table)
    {

        if (($cart_id = session()->get('cart_id')) != null) {
            $current_cart = Cart::find($cart_id);
            if (is_null($current_cart) || $current_cart->status == 1) {
                $current_cart = Cart::create(['table_id' => $table->id]);
                session()->put(['cart_id' => $current_cart->id]);
            }
        } else {
            $current_cart = Cart::create(['table_id' => $table->id]);
            session()->put(['cart_id' => $current_cart->id]);
        }

        return $current_cart ?? null;
    }


    public function new($token)
    {
        // recupero il token
//        $table_id = Crypt::decrypt($token);

        $table = Table::where('number','=',$token)->first();
        // recupero il numero del tavolo in base al token
        /** @var Table $table */
//        $table = Table::find($table_id);

        // se il token è valido, rimando alla pagina di prenotazione
        if ($table) {

            $cart = $this->getCart($table);
            $cart->load('products');

            $table->carts()->save($cart);
            return view('Lucmas\Reservations\Views::reservation.new', ['table' => $table, 'cart' => $cart]);
        } else {
            Log::error('Nessun token ricevuto');
            return view('Lucmas\Reservations\Views::reservation.error',
                ['message' => 'Token non valido']
            );

        }

    }

    /**
     * @return Application|Factory|View
     * @throws BindingResolutionException
     */
    public function newGuest()
    {

        /** @var Category $cat */
        $category = app()->make('Category');

        /** @var Category $cat */
        $cat = $category::with('translation');

        $request = app()->make('Request');
        $parent_id = $request->get('category') ?? null;

        //se la categoria selezionata a sottocategorie
        if (is_null($parent_id) || Category::find($parent_id)->children->count()) {
            $categories = $cat->where('parent_id', '=', $parent_id)->get();
        } else {
            return $this->getCategoryProducts(Category::find($parent_id));
        }

        return view('Lucmas\Reservations\Views::reservation.new',
            ['categories' => $categories ?? null]
        );
    }

    public function getCategoryProducts(Category $category)
    {
        $products = $category->products;
        return view('Lucmas\Reservations\Views::reservation.category_products', [
            'category' => $category,
            'products' => $products
        ]);

    }
}
