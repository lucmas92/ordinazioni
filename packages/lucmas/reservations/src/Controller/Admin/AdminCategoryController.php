<?php

namespace Lucmas\Reservations\Controller\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Lucmas\Reservations\Model\Category;
use Lucmas\Reservations\Model\Product;
use Lucmas\Reservations\Model\User;
use Illuminate\Http\Request;

class AdminCategoryController extends AdminController
{

    public function categories()
    {
        return \view('Lucmas\Reservations\Views::admin.category.index');

    }

    public function store(Request $request, Category $category)
    {

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
            'description_short' => 'max:255',
            'image' => 'dimensions:min_width=200,min_height=200'
        ]);
        $category->fill($request->all());
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->description_short = $request->get('description_short');

        if ($request->get('parent_id'))
            $category->parent_id = $request->get('parent_id');

        $category->save();

        return $category;
    }


    public function delete(Request $request, $category_id)
    {
        $category = Category::find($category_id);

        if (!$category_id) {
            return response()->json(['code' => '404', 'message' => 'Errore'], 404);
        }

        $category->delete();

        return response()->json(['code' => '204', 'message' => 'Eliminato'], 200);
    }

    public function update(Request $request, $categoryId)
    {
        $category = Category::find($categoryId);

        if (!$category) {
            return response()->json(['code' => '404', 'message' => 'Errore'], 404);
        }

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
            'description_short' => 'max:255',
        ]);
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->description_short = $request->get('description_short');
        $category->active = $request->get('active');
        $category->save();
        return $category;
    }

}
