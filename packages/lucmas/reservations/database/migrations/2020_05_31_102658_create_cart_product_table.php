<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Lucmas\Reservations\Seeds\TablesTableSeeder;

class CreateCartProductTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();
            $table->auditableWithDeletes();

            $table->foreign('cart_id')->references('id')->on('carts');
            $table->foreign('product_id')->references('id')->on('products');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('cart_product');
    }
}
