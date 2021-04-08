<?php

namespace Lucmas\Reservations\Controller;

use Illuminate\Http\Request;
use Lucmas\Reservations\Model\Cart;
use Lucmas\Reservations\Model\Order;
use Lucmas\Reservations\Model\OrderProduct;
use Lucmas\Reservations\Model\Table;

class OrderController extends Controller
{

    public function createOrderFromCart($cart_id)
    {

        /** @var Cart $cart */
        $cart = app()->make(Cart::class)->find($cart_id);

        /** @var Table $table */
        $table = $cart->table;

        // verifico se il tavolo ha gia un ordine aperto,
        // altrimenti ne creo uno nuovo
        $order = $table->order ?? new Order;

        $order->table()->associate($table);
        $order->save();
        $order->carts()->attach($cart);


        // aggiungo i prodotti del carrelo all'ordine
        $cart->products()->each(function ($product) use ($order) {
            $quantity = $product->pivot->quantity;
            logger(sprintf("aggiungo il prodotto %s (%s) all\'ordine %s", $product->id, $quantity, $order->id));
            // se il prodotto è già presente nell'ordine, aggiorno la quantità
//            if ($order->products()->where('product_id', '=', $product->id)->exists()) {
//                $quantity += $order->products()->find($product->id)->pivot->quantity;
//            }
            $order->products()->attach($product, ['quantity' => $quantity]);
//            $order->products()->updateExistingPivot($product->id, ['quantity' => $quantity]);
        });

        // modifico lo status del carrello
        $cart->status = 1;
        $cart->update();

        return $order;
    }

    public function getCount(Request $request)
    {
        $cart = Order::where('status', '=', Order::OPEN)->whereHas('products', function ($query) {
            $query->where('status', '=', OrderProduct::NEW);
        })->count();
        return response()->json($cart);
    }

    public function setProductDelivered($product_id)
    {
        $orderProduct = OrderProduct::find($product_id);
        $orderProduct->status = OrderProduct::DELIVERED;
        $orderProduct->update();
        return $orderProduct;
    }
}
