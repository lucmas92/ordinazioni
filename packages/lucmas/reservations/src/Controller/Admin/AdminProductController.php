<?php

namespace Lucmas\Reservations\Controller\Admin;

use Lucmas\Reservations\Model\Category;
use Lucmas\Reservations\Model\Product;
use Illuminate\Http\Request;

class AdminProductController extends AdminController
{

    public function products(){
        return \view('Lucmas\Reservations\Views::admin.product.index');

    }

    public function update(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (! $product) {
            return response()->json(['code' => '404','message' => 'Errore'], 404);
        }

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
            'description_short' => 'max:255',
        ]);
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->description_short = $request->get('description_short');
        $product->active = $request->get('active');
        $product->price = $request->get('price');
        $product->save();
        return $product;
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return Product
     */
    public function store(Request $request, Product $product)
    {

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
            'description_short' => 'max:255',
        ]);
        $product->fill($request->all());
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->description_short = $request->get('description_short');
        $product->save();

        // se è presente l'id della categoria da associare
        if ($request->get('category_id'))
            (Category::find($request->get('category_id')))->products()->save($product);

        return $product;
    }

    public function delete(Request $request, $product_id)
    {
        $product = Product::find($product_id);

        if (! $product) {
            return response()->json(['code' => '404','message' => 'Errore'], 404);
        }

        $product->delete();

        return response()->json(['code' => '204','message' => 'Eliminato'], 200);
    }

}
