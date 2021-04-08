<?php

namespace Lucmas\Reservations\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Lucmas\Reservations\Model\Cart;
use Lucmas\Reservations\Model\Product;
use Lucmas\Reservations\Model\Table;
use Lucmas\Reservations\Resources\CartProductResource;

class CartController extends Controller
{

    /**
     * @param Request $request
     * @param Table $table
     * @param Product $product
     * @return Cart
     */
    public function add(Request $request, $cart_id)
    {
        $request->validate([
            'table_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|min:1',
        ]);

        /** @var Cart $cart */
        $cart = Cart::find($cart_id);
        $cart->load('products');

        $table = Table::find($request->get('table_id'));
        $product = Product::find($request->get('product_id'));
        $quantity = $request->get('quantity');

        // verifico se il prodotto è già presente nel carrello
        $prod = $cart->products()->find($product->id);
        if ($prod) {
            $cart->products()->updateExistingPivot($product->id, ['quantity' => $quantity]);
            Log::info(sprintf("Aggiornata quantità articolo nel carrello %s", $cart->id));
        } else {
            // altrimenti aggiungo il prodotto alla categoria
            try {
                $cart->products()->attach($product->id, ['quantity' => $quantity]);
                Log::info(sprintf("Aggiunto articolo nel carrello %s", $cart->id));
            } catch (\Exception $e) {
                logger($e->getMessage());
            }
        }

        return $cart;
    }

    public function delete(Request $request, $cart_id, $product_id)
    {
        $cart = Cart::find($cart_id);
        $cart->load('products');

        $cart->products()->detach(Product::find($product_id));
        $cart->save();
        Log::info(sprintf("Articolo rimosso dal carrello %s", $cart->id));
        return $cart;
    }

    public function products(Request $request, $cart_id)
    {
        $cart = Cart::find($cart_id);

        Log::info(sprintf("Recupero elenco articoli nel carrello %s", $cart->id));

        // se il carrello non è stato chiuso
        if ($cart->status == 0)
            return CartProductResource::collection($cart->products);

        else return response()->noContent();
    }

    public function create(Request $request, $table_id)
    {
        $current_cart = Cart::create(['table_id' => $table_id]);
        session()->put(['cart_id' => $current_cart->id]);
        return $current_cart;

    }

    public function getCount(Request $request)
    {
        $cart = Cart::where('status','=','0')->orderBy('created_at','desc')->count();
        return response()->json($cart);
    }
}
