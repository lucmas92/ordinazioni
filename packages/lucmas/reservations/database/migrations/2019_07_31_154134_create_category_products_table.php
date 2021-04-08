<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Lucmas\Reservations\Model\Category;
use Lucmas\Reservations\Model\Product;

class CreateCategoryProductsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('category_products', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('position')->nullable();
            $table->timestamps();
            $table->auditable();

            $table->primary(['category_id', 'product_id']);

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });


        $cat = Category::whereHas('translation',function ($query){
            $query->where('name','=','Caffetteria');
        })->first();
        $products = Product::whereIn('id',[5,6])->get();
        foreach ($products as $prod){
            $prod->categories()->save($cat);
            $prod->save();
        }

        $cat = Category::whereHas('translation',function ($query){
            $query->where('name','=','Bibite');
        })->first();
        $products = Product::whereIn('id',[3,4])->get();
        foreach ($products as $prod){
            $prod->categories()->save($cat);
            $prod->save();
        }

        $cat = Category::whereHas('translation',function ($query){
            $query->where('name','=','Aperitivi');
        })->first();
        $products = Product::whereIn('id',[1,2])->get();
        foreach ($products as $prod){
            $prod->categories()->save($cat);
            $prod->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('category_products');
    }
}
